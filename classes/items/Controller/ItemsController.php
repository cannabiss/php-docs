<?php
class ItemsController
{
    private $ITEM_ID = null;
    private $CHAPTER_ID = null;
    private $ITEMS = null;
    private $CHAPTER_LIST = null;
    private $ITEM = null;

    public function index()
    {
        $this->ITEMS = Items::getItems();

        if (isset($_POST['id'])) {
            $this->ITEM_ID = $_POST['id'];
        }

        if ($this->ITEM_ID) {
            $this->viewItem();
        } else {
            if ($_POST['action']) {
                if ($_POST['action'] == 'edit' or $_POST['action'] == 'editsave') {
                    $this->ITEM_ID = $_POST['item_id'];
                    $this->editItem($this->ITEM_ID);
                } elseif ($_POST['action'] == 'delete') {
                    $this->ITEM_ID = $_POST['item_id'];
                    $this->deleteItem($this->ITEM_ID);
                } else {
                    $this->addItem();
                }
            } else {
                $data['items'] = $this->ITEMS;
                View::loadTemplate('items', $data);
            }
        }
    }

    protected function viewItem() {
        $item = Items::getItem($this->ITEM_ID);
        $this->CHAPTER_ID = $item['chapter_id'];
        $chapter = Items::getChapterItem($this->CHAPTER_ID);

        $data['item'] = $item;
        $data['item']['chapter'] = $chapter['name'];
        $data['item']['title'] = '';
        View::loadTemplate('item', $data, 'items');
    }

    protected function editItem($item_id) {
        $this->ITEM = Items::getItem($item_id);
        $data['item'] = $this->ITEM;
        $data['title'] = 'Изменение параграфа.';

        if ($_POST['action'] == 'editsave') {
            $itemData['id'] = $this->ITEM_ID;
            $itemData['name'] = $_POST['name'];
            $itemData['description'] = $_POST['description'];
            $itemData['date_update'] = $_POST['date_update'];
            $itemData['item_text'] = $_POST['item_text'];
            if (Items::updateItem($item_id, $itemData)) {
                $data['success'] = 'Данные успешно сохранены.';
            } else {
                $data['error'] = 'Ошибка сохранения данных.';
            }
        }

        unset($_POST['action']);

        View::loadTemplate('itemEdit', $data, 'items');
    }

    protected function deleteItem($item_id) {
        unset($_POST['action']);
        if (Items::removeItem($item_id)) {
            $data['items'] = $this->ITEMS;
            $data['refresh'] = 'yes';
            View::loadTemplate('items', $data);
        } else {
            $data['error'] = "Ошибка удаления параграфа!";
            View::loadTemplate('item', $data, 'items');
        }
    }

    protected function addItem() {
        $this->CHAPTER_LIST = Items::getItemChapters();
        $data['chapters'] = $this->CHAPTER_LIST;

        if ($_POST['action'] != 'add') {
            if (!$_POST['name'] or !$_POST['description'] or !$_POST['chapter_name'] or !$_POST['item_text']) {
                $data['error'] = "Ошибка вставки записи. Проверьте корректность заполнения данных!";
            } elseif ($_POST['name'] and $_POST['description'] and $_POST['chapter_name'] and $_POST['item_text']) {
                $chapter_name = $_POST['chapter_name'];
                $chapter_id = substr($chapter_name, 0, (strlen($chapter_name) - strlen(strstr($chapter_name, ')'))));
                $item_info['chapter_id'] = $chapter_id;
                $item_info['name'] = addslashes($_POST['name']);
                $item_info['description'] = addslashes($_POST['description']);
                $item_info['item_text'] = addslashes($_POST['item_text']);
                $autor = Items::getItemAuthor($_SESSION['user_id']);
                $item_info['author_id'] = $autor['id'];
                $item_info['author'] = $autor['name'].' '.$autor['surname'];
                $date = date('Y-m-d');
                $item_info['date_create'] = $date;
                $item_info['date_update'] = $date;

                if (Items::insertItem($item_info))
                    $data['success'] = "Данные успешно сохранены!";
            }
        }
        $data['item']['title'] = 'Создание нового параграфа.';
        View::loadTemplate('itemAdd', $data, 'items');
    }
}