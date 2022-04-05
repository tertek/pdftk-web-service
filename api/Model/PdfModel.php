<?php

class PdfModel {

    public function getData($document) {

        $data = [
            $document => [
                "Foo" => "Bar",
                "Bar" => "Foo",
                "Loo" => "Luu"
            ]
        ];

        return $data;
    }

}