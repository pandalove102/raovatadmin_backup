<?php
class database extends dbconfig
{
    protected $pdo='';
    protected $sql='';
    protected $stateMent='';
    //php 7 kho vl
    public function __construct()
    {
        try// :: la
        {
			$this->pdo=new PDO('mysql:host='.$this->HOST.'; dbname='.$this->DBNAME,$this->USERNAME,$this->PASSWORD);
			$this->pdo->query('set names utf8');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
			//sua lai throw            
			exit($e->getMessage());
        }
    }
    public function setQuery($sql)
    {
        $this->sql=$sql;
    }
    //thuc hien truy van hanh dong: insert, update, delete
    public function execute($option=array())
    {
		try
        {
			$this->stateMent=$this->pdo->prepare($this->sql);
			$this->stateMent->execute($option);
			return $this->stateMent;
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
			//sua lai throw            
			exit($e->getMessage());
        }
    }
    //truy liet ke lay danh sach
    public function loadAllRow($option=array())
    {
		try{           
			$this->stateMent=$this->pdo->prepare($this->sql);
			$this->stateMent->execute($option);
			return $this->stateMent->fetchAll(PDO::FETCH_OBJ);
		}
        catch(PDOException $e)
        {
			//sua lai throw            
			exit($e->getMessage());
        }
    }
    //thuc hien truy van liet ke lay 1 mot tin
    public function loadRow($option=array())
    {
		try{
			$this->stateMent=$this->pdo->prepare($this->sql);
			$this->stateMent->execute($option);
			return $this->stateMent->fetch(PDO::FETCH_OBJ);
		}
        catch(PDOException $e)
        {
			//sua lai throw            
			exit($e->getMessage());
        }
    }
   
    public function lastInsertId()
    {
		try{
			return $this->pdo->lastInsertId();
		}
        catch(PDOException $e)
        {
			//sua lai throw            
			exit($e->getMessage());
        }
    }
	public function disconnect()
    {
        return $this->pdo=null;
    }
    public function countAll($option=array())
    {
		try{
			$this->stateMent=$this->pdo->prepare($this->sql);
			$this->stateMent->execute($option=array());
			return $this->stateMent->rowCount();
		}
        catch(PDOException $e)
        {
			//sua lai throw            
			exit($e->getMessage());
        }
    }
    
}
?>