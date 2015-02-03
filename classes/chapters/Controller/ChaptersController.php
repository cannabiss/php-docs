<?php

class ChaptersController
{
    private $CHAPTER_ID = null;
    private $SECTION_LIST = null;
    private $CHAPTERS = null;
    private $CHAPTER = null;
    private $ITEMS = null;

    public function index()
    {
        $this->CHAPTERS = Chapters::getChapters();

        if (isset($_POST['id'])) {
            $this->CHAPTER_ID = $_POST['id'];
            $this->ITEMS = Chapters::getItems($this->CHAPTER_ID);
            $this->CHAPTER = Chapters::getChapter($this->CHAPTER_ID);
        }

        if ($this->CHAPTER_ID) {
            $this->viewChapter();
        } else {
            if ($_POST['action']) {
                if ($_POST['action'] == 'edit' or $_POST['action'] == 'editsave') {
                    $this->CHAPTER_ID = $_POST['chapter_id'];
                    $this->editChapter($this->CHAPTER_ID);
                } elseif ($_POST['action'] == 'delete') {
                    $this->CHAPTER_ID = $_POST['chapter_id'];
                    $this->deleteChapter($this->CHAPTER_ID);
                } else {
                    $this->addChapter();
                }
            } else {
                $data['chapters'] = $this->CHAPTERS;
                View::loadTemplate('chapters', $data);
            }
        }
    }

    protected function viewChapter()
    {
        $data['chapter'] = $this->CHAPTER;
        $data['items'] = $this->ITEMS;
        $data['chapter']['title'] = '';
        View::loadTemplate('chapter', $data, 'chapters');
    }

    protected function addChapter()
    {
        $this->SECTION_LIST = Chapters::getSections();
        $data['sections'] = $this->SECTION_LIST;
        if ($_POST['action'] != 'add') {
            if (!$_POST['name'] or !$_POST['description'] or !$_POST['section_name']) {
                $data['error'] = "Ошибка вставки записи. Проверьте корректность заполнения данных!";
            } elseif ($_POST['name'] and $_POST['description'] and $_POST['section_name']) {
                $section_name = $_POST['section_name'];
                $section_id = substr($section_name, 0, (strlen($section_name) - strlen(strstr($section_name, ')'))));
                $chapter_info['section_id'] = $section_id;
                $chapter_info['name'] = addslashes($_POST['name']);
                $chapter_info['description'] = addslashes($_POST['description']);
                $chapter_info['user_id'] = $_SESSION['user_id'];
                $date = date('Y-m-d');
                $chapter_info['date_create'] = $date;
                $chapter_info['date_update'] = $date;

                if (Chapters::insertChapter($chapter_info))
                    $data['success'] = "Данные успешно сохранены!";
            }
        }
        $data['chapter']['title'] = 'Создание новой главы.';
        View::loadTemplate('chapterAdd', $data, 'chapters');
    }

    protected function deleteChapter($chapter_id)
    {
        unset($_POST['action']);
        if (Chapters::removeChapter($chapter_id)) {
            $data['chapters'] = $this->CHAPTERS;
            $data['refresh'] = 'yes';
            View::loadTemplate('chapters', $data);
        } else {
            $data['error'] = "Ошибка удаления раздела!";
            View::loadTemplate('chapter', $data, 'chapters');
        }
    }

    protected function editChapter($chapter_id)
    {
        $this->CHAPTER = Chapters::getChapter($chapter_id);
        $data['chapter'] = $this->CHAPTER;
        $data['title'] = 'Изменение главы.';

        if ($_POST['action'] == 'editsave') {
            $chapterData['id'] = $this->CHAPTER_ID;
            $chapterData['name'] = $_POST['name'];
            $chapterData['description'] = $_POST['description'];
            $chapterData['date_update'] = $_POST['date_update'];
            if (Chapters::updateChapter($chapter_id, $chapterData)) {
                $data['success'] = 'Данные успешно сохранены.';
            } else {
                $data['error'] = 'Ошибка сохранения данных.';
            }
        }

        unset($_POST['action']);

        View::loadTemplate('chapterEdit', $data, 'chapters');
    }
}