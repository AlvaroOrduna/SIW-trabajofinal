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

namespace Views;

use Core\AbstractView;
use Interfaces\BlogInterface;
use Models\Article;
use utils\Session;
use views\parts\FooterPartialView;
use views\parts\HeaderPartialView;

class ArticleView extends AbstractView implements BlogInterface
{
    private $article;

    /**
     * ArticleView constructor.
     * @param Article $article
     * @throws \Exception
     */
    public function __construct($article)
    {
        parent::__construct(new HeaderPartialView(true), new FooterPartialView());

        $this->setTemplateFile(PROJECT_TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'article.html');

        if (is_null($article)) {
            throw new \Exception("Not found", 404);
        } else {
            $this->article = $article;
        }

        $this->setTitle($article->getTitle() . ' | ' . PROJECT_NAME);
    }

    public function render()
    {
        $template = parent::render();

        $template = str_replace(self::KEY_ARTICLE_ID, $this->article->getId(), $template);
        $template = str_replace(self::KEY_ARTICLE_TITLE, $this->article->getTitle(), $template);
        $template = str_replace(self::KEY_ARTICLE_BODY, $this->article->getBody(), $template);
        $template = str_replace(self::KEY_ARTICLE_TIME, $this->article->getTime(), $template);

        if (is_null($this->article->getAuthorName())) {
            $template = str_replace(self::KEY_ARTICLE_AUTHOR_LINK, '', $template);
            $template = str_replace(self::KEY_ARTICLE_AUTHOR, 'Desconocido', $template);
        } else {
            $link = 'href="profile.php?user=' . $this->article->getAuthorId() . '"';
            $template = str_replace(self::KEY_ARTICLE_AUTHOR_LINK, $link, $template);
            $template = str_replace(self::KEY_ARTICLE_AUTHOR, $this->article->getAuthorName(), $template);
        }

        $template = $this->renderActions($template);

        echo $template;
    }

    private function renderActions($template)
    {
        if (Session::checkUserSession()) {
            $template = str_replace(self::KEY_ACTIONS, '', $template);

            $user = Session::getUser();

            if ($user->isWriter()) {
                $template = str_replace(self::KEY_ACTIONS_WRITER, '', $template);
            } else {
                $template_parts = explode(self::KEY_ACTIONS_WRITER, $template);
                $template = $template_parts[0] . $template_parts[2];
            }
        } else {
            $template_parts = explode(self::KEY_ACTIONS, $template);
            $template = $template_parts[0] . $template_parts[2] . $template_parts[4];
        }

        return $template;
    }
}
