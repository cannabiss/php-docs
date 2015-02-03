<?php
class TableManager
{
    private $data = array();
    private $columName = array();
    private $hiddenColumn = array();

    public function setTableData($data = array(), $columName = array(), $hidden = array())
    {

        $this->data = $data;
        $this->columName = $columName;
        $this->hiddenColumn = $hidden;

    }

    public function createTable($table_class = 'table table-striped')
    {
        $table = "<table class='" . $table_class . "'>";
        if (empty($this->data))
            return null;

        if (!empty($this->columName)) {
            $table .= "<tr>";
            foreach ($this->columName as $name) {
                $table .= "<td style='text-align: center'><b>" . $name . "<b></td>";
            }
            $table .= "</tr>";
        }

        foreach ($this->data as $key => $values) {
            $num = $key + 1;
            $table .= "<tr>";
            $table .= "<td style='text-align: center'><b>" . $num . "</b></td>";
            foreach ($values as $kod => $val) {
                if (in_array($kod, $this->hiddenColumn)) {
                    $table .= "<td  style='color: #0088CC' class='hidden'>" . $val . "</td>";
                } else {
                    if ($kod !== 'action') {
                        if (strlen($val) < 70) {
                            $table .= "<td  style='color: #0088CC'>" . $val . "</td>";
                        } else
                            $table .= "<td  style='color: #0088CC'><textarea style='width: 100%; height: 50px; color: black; font-size: 12px' disabled='true'>" . $val . "</textarea></td>";
                    } else {
                        $table .= "<td  style='color: #0088CC; text-align: center'>" . $val . "</td>";
                    }
                }
            }
            $table .= "</tr>";
        }
        $table .= "</table>";

        return $table;
    }

    public function addColumnData($data = array(), $name, $alias = null, $hidden = false)
    {
        if ($alias)
            array_push($this->columName, $alias);

        foreach ($this->data as $key => $values) {
            $this->data[$key][$name] = $data[$key];
        }

        if ($hidden)
            array_push($this->hiddenColumn, $name);

    }

    public function addColumnAction($alias = null, $icon = 'glyphicon glyphicon-arrow-right', $dataPost = null)
    {
        if ($alias)
            array_push($this->columName, $alias);

        foreach ($this->data as $key => $values) {
            $this->data[$key]['action'] = "<form action='" . Route::getCurPage() . "' method='post'>
                                                <input type='hidden' class='form-control' name='" . $dataPost . "' value=" . $this->data[$key][$dataPost] . ">
                                                <button type='submit'>
                                                    <i class='" . $icon . "'></i>
                                                </button>
                                           </form>";
        }
    }

}