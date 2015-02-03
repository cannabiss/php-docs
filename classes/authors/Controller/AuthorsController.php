<?php
class AuthorsController
{
    private $AUTHOR_ID = null;
    private $AUTHORS = null;
    private $AUTHOR = null;

    public function index()
    {
        $this->AUTHORS = Authors::getAuthors();

        if (isset($_POST['id'])) {
            $this->AUTHOR_ID = $_POST['id'];
        }

        if ($this->AUTHOR_ID) {
            $this->viewAuthor();
        } else {
            if ($_POST['action']) {
                if ($_POST['action'] == 'edit' or $_POST['action'] == 'editsave') {
                    $this->AUTHOR_ID = $_POST['author_id'];
                    $this->editAuthor($this->AUTHOR_ID);
                } elseif ($_POST['action'] == 'delete') {
                    $this->AUTHOR_ID = $_POST['author_id'];
                    $this->deleteAuthor($this->AUTHOR_ID);
                } else {
                    $this->addAuthor();
                }
            } else {
                $data['authors'] = $this->AUTHORS;
                View::loadTemplate('authors', $data);
            }
        }
    }

    protected function viewAuthor() {
        $this->AUTHOR  = Authors::getAuthor($this->AUTHOR_ID);
        $data['author'] = $this->AUTHOR;
        $data['author']['title'] = '';
        View::loadTemplate('author', $data, 'authors');
    }

    protected function editAuthor($author_id) {
        $this->AUTHOR = Authors::getAuthor($author_id);
        $data['author'] = $this->AUTHOR;
        $data['title'] = 'Изменение данных пользователя.';

        if ($_POST['action'] == 'editsave') {
            $authorData['id'] = $this->AUTHOR_ID;
            $authorData['name'] = addslashes($_POST['name']);
            $authorData['surname'] = addslashes($_POST['surname']);
            $authorData['login'] = addslashes($_POST['login']);
            $authorData['password'] = addslashes(md5($_POST['password']));
            $authorData['date_birth'] = $_POST['date_birth'];
            $authorData['country'] = addslashes($_POST['country']);
            $authorData['city'] = addslashes($_POST['city']);
            $authorData['specialization'] = addslashes($_POST['specialization']);
            $authorData['mail'] = addslashes($_POST['mail']);
            if ($_POST['is_admin'] == 'on')
                $authorData['is_admin'] = 1;
            if (Authors::updateAuthor($this->AUTHOR_ID, $authorData)) {
                $data['success'] = 'Данные успешно сохранены.';
            } else {
                $data['error'] = 'Ошибка сохранения данных.';
            }
        }

        unset($_POST['action']);

        View::loadTemplate('authorEdit', $data, 'authors');
    }

    protected function deleteAuthor($author_id) {
        unset($_POST['action']);
        if (Authors::removeAuthor($author_id)) {
            $data['author'] = $this->AUTHORS;
            $data['refresh'] = 'yes';
            View::loadTemplate('authors', $data);
        } else {
            $data['error'] = "Ошибка удаления пользователя!";
            View::loadTemplate('author', $data, 'author');
        }
    }

    protected function addAuthor() {
        if ($_POST['action'] != 'add') {
            if (!$_POST['name'] or !$_POST['surname'] or !$_POST['login']
                or !$_POST['password'] or !$_POST['mail']) {
                $data['error'] = "Ошибка вставки записи. Проверьте корректность заполнения данных!";
            } elseif ($_POST['name'] and $_POST['surname'] and  $_POST['login']
                and  $_POST['password'] and  $_POST['mail']) {
                $author_info['name'] = addslashes($_POST['name']);
                $author_info['surname'] = addslashes($_POST['surname']);
                $author_info['login'] = addslashes($_POST['login']);
                $author_info['password'] = addslashes(md5($_POST['password']));
                $author_info['date_birth'] = $_POST['date_birth'];
                $author_info['country'] = addslashes($_POST['country']);
                $author_info['city'] = addslashes($_POST['city']);
                $author_info['specialization'] = addslashes($_POST['specialization']);
                $author_info['mail'] = addslashes($_POST['mail']);
                if ($_POST['is_admin'] == 'on')
                    $author_info['is_admin'] = 1;

                if (Authors::insertAuthor($author_info))
                    $data['success'] = "Данные успешно сохранены!";
            }
        }
        $data['author']['title'] = 'Добавление пользователя.';
        View::loadTemplate('authorAdd', $data, 'authors');
    }
}