<?php

namespace rqdev\packages\ComputerVisionAPI\GenerateThumbnail;

trait ImageProperties {

    static protected $data;
    static protected $properties;

    static public function FileName() {
        return self::$properties['FileName'];
    }

    static public function FileDateTime() {
        return self::$properties['FileDateTime'];
    }

    static public function FileSize() {
        return self::$properties['FileSize'];
    }

    static public function FileType() {
        return self::$properties['FileType'];
    }

    static public function MimeType() {
        return self::$properties['MimeType'];
    }

    static public function SectionsFound() {
        return self::$properties['SectionsFound'];
    }

    static public function getProperties() {
        return self::$properties;
    }

}

class Helper {

    static protected $imageData;

    public function __construct(string $imageData) {
        self::$imageData = $imageData;
    }

    static public function toBase64() {
        return base64_encode(self::$imageData);
    }

    static public function getHtml() {
        $details = self::ImageDetails();
        $data = 'data://' . $details::MimeType() . ';base64,' . self::toBase64();
        $str = '<img src="' . $data . '" "' . $details::getProperties()['COMPUTED']['html'] . '>';
        return $str;
    }

    static public function ImageDetails() {

        return new class(self::toBase64()) {

            use ImageProperties;

            public function __construct(string $base64) {
                self::$data = $base64;
                self::$properties = exif_read_data('data://image/jpeg;base64,' . self::$data);
            }
        };
    }

}
