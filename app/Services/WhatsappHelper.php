<?php

namespace App\Helpers;

class WhatsAppHelper
{
    /**
     * Convert Indonesian phone number to international format for WhatsApp
     * 
     * @param string $phoneNumber
     * @return string
     */
    public static function formatForWhatsApp($phoneNumber)
    {
        if (empty($phoneNumber)) {
            return '';
        }

        // Remove all non-numeric characters
        $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Remove leading zeros
        $cleanNumber = ltrim($cleanNumber, '0');

        // Handle different Indonesian number formats
        if (strlen($cleanNumber) >= 9) {
            // If starts with 62 (already international format)
            if (substr($cleanNumber, 0, 2) === '62') {
                return $cleanNumber;
            }

            // If starts with 8 (mobile number without leading 0)
            if (substr($cleanNumber, 0, 1) === '8') {
                return '62' . $cleanNumber;
            }

            // If it's a complete number starting with other digits
            // Assume it's missing country code
            return '62' . $cleanNumber;
        }

        return $cleanNumber;
    }

    /**
     * Generate WhatsApp URL with optional message
     * 
     * @param string $phoneNumber
     * @param string $message
     * @return string
     */
    public static function generateWhatsAppUrl($phoneNumber, $message = '')
    {
        $formattedNumber = self::formatForWhatsApp($phoneNumber);

        if (empty($formattedNumber)) {
            return '#';
        }

        $url = 'https://wa.me/' . $formattedNumber;

        if (!empty($message)) {
            $url .= '?text=' . urlencode($message);
        }

        return $url;
    }

    /**
     * Generate WhatsApp URL specifically for UMKM contact
     * 
     * @param object $umkm UMKM model instance
     * @param string $customMessage Optional custom message
     * @return string
     */
    public static function generateUmkmWhatsAppUrl($umkm, $customMessage = '')
    {
        if (empty($customMessage)) {
            $customMessage = "Halo, saya tertarik dengan produk {$umkm->nama_produk} dari {$umkm->nama_usaha}. Mohon informasi lebih lanjut.";
        }

        return self::generateWhatsAppUrl($umkm->nomor_telepon, $customMessage);
    }

    /**
     * Validate Indonesian phone number format
     * 
     * @param string $phoneNumber
     * @return bool
     */
    public static function isValidIndonesianNumber($phoneNumber)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Indonesian mobile numbers typically:
        // - Start with 08 (domestic format)
        // - Or start with 628 (international format)
        // - Have 10-13 digits total

        if (preg_match('/^08[1-9][0-9]{7,10}$/', $cleanNumber)) {
            return true; // Domestic format
        }

        if (preg_match('/^628[1-9][0-9]{7,10}$/', $cleanNumber)) {
            return true; // International format
        }

        return false;
    }

    /**
     * Format phone number for display (with country code visible)
     * 
     * @param string $phoneNumber
     * @return string
     */
    public static function formatForDisplay($phoneNumber)
    {
        $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (substr($cleanNumber, 0, 2) === '62') {
            // Already international format
            $withoutCountryCode = substr($cleanNumber, 2);
            return '+62 ' . chunk_split($withoutCountryCode, 4, ' ');
        }

        if (substr($cleanNumber, 0, 1) === '0') {
            // Domestic format, convert to international display
            $withoutZero = substr($cleanNumber, 1);
            return '+62 ' . chunk_split($withoutZero, 4, ' ');
        }

        return $phoneNumber; // Return as-is if format not recognized
    }
}