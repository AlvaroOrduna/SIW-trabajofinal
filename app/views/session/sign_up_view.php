<?php

/**
 * Copyright (C) 2016 Álvaro Orduna León
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Views\Session;


use App\Core\AbstractView;
use App\Views\FooterPartial;
use App\Views\HeaderPartial;

class SignUpView extends AbstractView
{
    const KEY_MESSAGE = '##MESSAGE##';

    private $message;

    /**
     * SignUpView constructor.
     * @param string $msg
     * @throws \Exception
     */
    public function __construct($msg = '')
    {
        parent::__construct(new HeaderPartial(), new FooterPartial());
        $this->setTemplateFile(FOLDER_TEMPLATES . DIRECTORY_SEPARATOR . 'session' . DIRECTORY_SEPARATOR . 'sign_up.html');
        $this->setTitle('Sign Up | ' . PROJECT_NAME);
        $this->message = $msg;
    }

    public function render()
    {
        $template = parent::render();
        $template = str_replace(self::KEY_MESSAGE, $this->message, $template);
        echo $template;
    }
}
