<?php
class SectionsController
{
    private $SECTION_ID = null;
    private $SECTIONS = null;
    private $CHAPTERS = null;

    public function index()
    {
        $this->SECTIONS = Sections::getSections();

        if (isset($_POST['id'])) {
            $this->SECTION_ID = $_POST['id'];
            $this->CHAPTERS = Sections::getChapters($this->SECTION_ID);
        }

        if ($this->SECTION_ID) {
            $this->viewSection();
        } else {
            if ($_POST['action']) {
                if ($_POST['action'] == 'edit' or $_POST['action'] == 'editsave') {
                    $this->SECTION_ID = $_POST['section_id'];
                    $this->editSection($this->SECTION_ID);
                } elseif ($_POST['action'] == 'delete') {
                    $this->SECTION_ID = $_POST['section_id'];
                    $this->deleteSection($this->SECTION_ID);
                } else {
                    $this->addSection();
                }
            } else {
                $data['sections'] = $this->SECTIONS;
                View::loadTemplate('sections', $data);
            }
        }
    }

    protected function viewSection()
    {
        $section = Sections::getSection($this->SECTION_ID);

        if (!empty($this->CHAPTERS)) {
            foreach ($this->CHAPTERS as $key => $chapter)
                $this->CHAPTERS[$key]['items'] = Sections::getItems($chapter['id']);
        }

        $data['chapters'] = $this->CHAPTERS;
        $data['section']['content'] = $section;
        $data['section']['title'] = '';
        View::loadTemplate('section', $data, 'sections');
    }

    protected function addSection()
    {
        if ($_POST['action'] != 'add') {
            if (!$_POST['name'] or !$_POST['description']) {
                $data['error'] = "Ошибка вставки записи. Проверьте корректность заполнения данных!";
            } elseif ($_POST['name'] and $_POST['description']) {
                $section_info['name'] = addslashes($_POST['name']);
                $section_info['description'] = addslashes($_POST['description']);
                $section_info['user_id'] = $_SESSION['user_id'];
                $date = date('Y-m-d');
                $section_info['date_create'] = $date;
                $section_info['date_update'] = $date;

                if (Sections::insertSection($section_info))
                    $data['success'] = "Данные успешно сохранены!";
            }
        }
        $data['section']['title'] = 'Создание нового раздела';
        View::loadTemplate('sectionAdd', $data, 'sections');
    }

    protected function deleteSection($section_id)
    {
        unset($_POST['action']);
        if (Sections::deleteSection($section_id)) {
            $data['sections'] = $this->SECTIONS;
            $data['refresh'] = 'yes';
            View::loadTemplate('sections', $data);
        } else {
            $data['error'] = "Ошибка удаления раздела!";
            View::loadTemplate('section', $data, 'sections');
        }

    }

    protected function editSection($section_id)
    {
        $data['section'] = Sections::getSection($section_id);
        $data['title'] = 'Изменение раздела';
        if ($_POST['action'] == 'editsave') {

            $sectionData['id'] = $this->SECTION_ID;
            $sectionData['name'] = $_POST['name'];
            $sectionData['description'] = $_POST['description'];
            $sectionData['date_update'] = $_POST['date_update'];

            if (Sections::updateSection($section_id, $sectionData)) {
                $data['success'] = 'Данные успешно сохранены.';
            } else {
                $data['error'] = 'Ошибка сохранения данных.';
            }
        }
        unset($_POST['action']);

        View::loadTemplate('sectionEdit', $data, 'sections');
    }
}