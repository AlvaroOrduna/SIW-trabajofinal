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

namespace views;


use Core\AbstractView;
use views\parts\FooterPartialView;
use views\parts\HeaderPartialView;

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
        parent::__construct(new HeaderPartialView(true, false, true), new FooterPartialView());

        $this->setTemplateFile(PROJECT_TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'sign_up.html');
        $this->setTitle('SignUp | ' . PROJECT_NAME);

        $this->message = $msg;
    }

    public function render()
    {
        $template = parent::render();
        $template = str_replace(self::KEY_MESSAGE, $this->message, $template);
        echo $template;
    }
}