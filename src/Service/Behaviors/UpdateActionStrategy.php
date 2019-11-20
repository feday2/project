<?php

namespace App\Service\Behaviors;

class UpdateActionStrategy
{
    public function getUpdateAction($case): UpdateActionInterface
    {
        $url = '';
        $message = "Please, update browser";
        switch ($case) {
            case "mobile":
                $message = "Mobile not support never";
                break;
            case "chrome":
                $url = "https://www.google.com/intl/ru/chrome/";
                break;
            case "mozilla":
                $url = "https://support.mozilla.org/en-US/kb/update-firefox-latest-release";
                break;
        }

        return new UpdateAction($message, $url);
    }
}