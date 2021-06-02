<?php

namespace App\Traits;

/**
 * redirect to different pages and sections with inputs and errors
 */
trait RedirectPages
{

    public function redirectTo(string $to, string $section = '', array $messages = [], bool $withInputs = false, $errors = null)
    {
        if ($to == null || strlen($to) < 1) {
            return redirect('/');
        }
        $section = strlen($section) > 0 ? "#{$section}" : '';
        $to = $this->endsWith($to, $section) ? $to : $to . $section; 

        if ($withInputs == false && $errors == null) {
            return redirect($to)->with($messages);
        } else if ($withInputs == true) {
            if ($errors == null) {
                return redirect($to)->with($messages)->withInput();
            } else {
                return redirect($to)->with($messages)->withInput()->withErrors($errors);                
            }
        } else if ($errors != null) {
            return redirect($to)->with($messages)->withErrors($errors);
        } else {
            return redirect('/');
        }

    }

    private function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if(!$length) {
            return true;
        }
        return substr($haystack, -$length) === $needle;
    }

}
