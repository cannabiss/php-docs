<?php
class NewsController
{
    private $NEW_ID = null;
    private $NEW = null;
    private $NEWS = null;

    public function index()
    {
        $this->NEWS = BlockNews::getNews();

        if (isset($_POST['id'])) {
            $this->NEW_ID = $_POST['id'];
        }

        if ($this->NEW_ID) {
            $this->viewNew();
        } else {
            if ($_POST['action']) {
                if ($_POST['action'] == 'edit' or $_POST['action'] == 'editsave') {
                    $this->NEW_ID = $_POST['new_id'];
                    $this->editNew($this->NEW_ID);
                } elseif ($_POST['action'] == 'delete') {
                    $this->NEW_ID = $_POST['new_id'];
                    $this->deleteNew($this->NEW_ID);
                } else {
                    $this->addNew();
                }
            } else {
                $data['news'] = $this->NEWS;
                View::loadTemplate('news', $data);
            }
        }
    }

    protected function viewNew() {
        $new  = BlockNews::getNew($this->NEW_ID);
        $data['new'] = $new;
        $data['item']['title'] = '';
        View::loadTemplate('new', $data, 'news');
    }

    protected function editNew($new_id) {
        $this->NEW = BlockNews::getNew($new_id);
        $data['new'] = $this->NEW;
        $data['title'] = 'Изменение Новостей.';

        if ($_POST['action'] == 'editsave') {
            $newData['id'] = $this->NEW_ID;
            $newData['name'] = $_POST['name'];
            $newData['description'] = $_POST['description'];
            $newData['date_update'] = $_POST['date_update'];
            if (BlockNews::updateNew($new_id, $newData)) {
                $data['success'] = 'Данные успешно сохранены.';
            } else {
                $data['error'] = 'Ошибка сохранения данных.';
            }
        }

        unset($_POST['action']);

        View::loadTemplate('newEdit', $data, 'news');
    }

    protected function addNew() {

        if ($_POST['action'] != 'add') {
            if (!$_POST['name'] or !$_POST['description']) {
                $data['error'] = "Ошибка вставки записи. Проверьте корректность заполнения данных!";
            } elseif ($_POST['name'] and $_POST['description']) {
                $new_info['name'] = addslashes($_POST['name']);
                $new_info['description'] = addslashes($_POST['description']);
                $new_info['user_id'] = $_SESSION['user_id'];
                $date = date('Y-m-d');
                $new_info['date_create'] = $date;
                $new_info['date_update'] = $date;

                if (BlockNews::insertNew($new_info))
                    $data['success'] = "Данные успешно сохранены!";
            }
        }
        $data['item']['title'] = 'Добавление новостей.';
        View::loadTemplate('newAdd', $data, 'news');
    }

    protected function deleteNew($new_id) {
        unset($_POST['action']);
        if (BlockNews::removeNew($new_id)) {
            $data['news'] = $this->NEWS;
            $data['refresh'] = 'yes';
            View::loadTemplate('news', $data);
        } else {
            $data['error'] = "Ошибка удаления новости!";
            View::loadTemplate('new', $data, 'news');
        }
    }

}