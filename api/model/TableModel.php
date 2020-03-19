<?php

require_once 'config/DataBaseHandler.php';

class TableModel extends DataBaseHandler
{
    private $tableName;

    public function __construct(string $databaseName, string $tableName)
    {
        parent::__construct($databaseName);
        $this->tableName = $tableName;
    }
    /**
    *SELECT
    *
    *Генерирует часть SELECT
    *
    * @param    string  при использовании с WHERE должна быть как минимум * или столбцы через запятую
    * @return   string  запрос может быть дополнен конструкцией WHERE
     */
    private function selectBuilder(string $columns = '*') : string
    {
        return "SELECT $columns FROM $this->tableName ";
    }

    // --------------------------------------------------------------------

    /**
     * WHERE part
     * 
     * Генерирует часть WHERE с псевдопеременными
     * 
     * @param   array   ключи ассоциативного массива
     * @return  string  часть запроса нужен последующий байндинг
     */
    private function whereBuilder(array $columns = []) : string
    {
        if ($columns !== [])
        {
            $where = ' WHERE';
            foreach($columns as $key)
                $where .= " $key = :$key AND";
            
            return rtrim($where,"AND");
        }
        else
            return '';
    }

    // --------------------------------------------------------------------

    /**
     * INSERT
     * 
     * Генерирует полностью инсерт с псевдопеременными
     * 
     * @param   array   ассоциативный массив
     * @return  string  полный запрос нужен подальший байндинг
     */
    private function insertBuilder(array $columns) : string
    {
        $values = implode(', ', array_keys($columns));
        $binds = implode(', :', array_keys($columns));
        
        return 
            "INSERT INTO $this->tableName ( $values ) 
            VALUES ( :$binds )";
    }

    // --------------------------------------------------------------------

    /**
     * UPDATE  part
     * 
     * Генерирует часть запросо с псевдопеременными
     * 
     * @param   array   ключи ассоциативного массива
     * @return  string  частично сгенерированый запрос
     *                  необходим последующий байндинг
     *                  c префиксом ":col$key"
     *                  префикс необходим для совместимости
     *                  с WHERE частью.. листаем ниже поймем
     * 
     */
    private function updateBuilder(array $columns) : string
    {
        $update = "UPDATE $this->tableName SET";
        foreach($columns as $key)
            $update .= " $key = :col$key, ";
        return rtrim($update," ,");
    }

    // --------------------------------------------------------------------

    /**
     * SELECT требует доработки
     * 
     * @param   string  колонки разделенные запятой либо функция
     * @param   array   ассоциативный массив WHERE
     *                  ["ColumnName"=>"ColumnValue"]
     * 
     * @return  array   Выборка из БД
     */
    public function select(string $columns = '*', array $where = []) : array
    {
        $stmt = $this->pdo->prepare( 
            $this->selectBuilder($columns) 
            . $this->whereBuilder(array_keys($where)) 
        );
        $stmt->execute($where);
        return $stmt->fetchAll();
    }
    //Примеры:
    //$table->select('Id');
    //$table->select('Id,Name');
    //$table->select();
    //$table->select('*',['Id'=>3]);
    //$table->select('Name',['Id'=>2, 'Name'=>'Whirlpool']);

    // --------------------------------------------------------------------

    /**
     * INSERT требует доработки
     * 
     * @param   array   Ассоциативный массив 
     *                  ["ColumnName"=>"ColumnValue"]
     * @return  bool    успешна ли операция
     *                  -1 пустой массив
     */
    public function insert(array $columns) : bool
    {
        if($columns === [])
            return false;
        $stmt = $this->pdo->prepare( $this->insertBuilder($columns) );
        return $stmt->execute($columns);
    }
    //Пример:
    //$fname = 'Ivan';
    //$phone = '+380578762293';
    //$email = 'iva999@gmail.com';
    //$users->insert(compact('fname','phone','email'));

    // --------------------------------------------------------------------

    /**
     * DELETE по заданому равенству
     * 
     * @param   array   Ассоциативный массив равенства
     *                  ["ColumnName"=>"ColumnValue"]
     * 
     * @return  int     Количество затронутых строк
     *                  -1 пустой массив
     */
    public function delete(array $where) : int
    {
        //data loss prevention
        if($where === [])
            return -1;
        $stmt = $this->pdo->prepare(
            "DELETE FROM $this->tableName" 
            . $this->whereBuilder(array_keys($where))
        );
        $stmt->execute($where);
        return $stmt->rowCount();
    }
    //Пример:
    //$categories->delete(['Name'=>'Phones']);

    // --------------------------------------------------------------------

    /**
     * Update по заданому равенству
     * Универсален как для PUT так и для PATCH
     * 
     * @param   array   Сущность или часть 
     *                  ["ColumnName"=>"ColumnValue"]
     * @param   array   Условие поиска равенство
     *                  ["ColumnName"=>"ColumnValue"]
     * 
     * @return  int     Количество затронутых строк
     *                  -1 один из массивов или оба пустые
     */
    public function update(array $columns,array $where) : int
    {
        if($columns === [] || $where === [])
            return -1;
        $stmt = $this->pdo->prepare(
            $this->updateBuilder(array_keys($columns))
            . $this->whereBuilder(array_keys($where))
        );
        foreach($columns as $key=>$value)
            $stmt->bindValue(":col$key",$value);
        foreach($where as $key=>$value)
            $stmt->bindValue(":$key",$value);
        $stmt->execute();
        return $stmt->rowCount();
    }
    //Пример:
    //$table->update(['Name'=>'Airbag2'],['Id'=>3,'Price'=>'1000']);

    // --------------------------------------------------------------------
}