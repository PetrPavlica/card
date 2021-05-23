<?php

use App\Model\PeopleModel;
use Nette\Utils\Image;
use Nette\Security\Passwords;
class CardForm extends Nette\Application\UI\Control
{
    private $peopleData;
    
    private $factory;
    
    private $dir;
 
    public $onPeopleSave;
    
    private $people_id=0;
    
    
    public $pozition = array(1=>'Zaměstnanec',
                   2=>'Účetní',
                   3=>'Admin');
    
    public function __construct(App\Model\PeopleModel $peopleData,\App\Forms\FormFactory $factory,$dir,$people_id)
    {
        
        $this->peopleData = $peopleData;
        $this->factory = $factory;
        $this->dir = $dir;
    }
    
    public function handlecreate($id){
        $this->people_id = $id;
    }
    
    public function createComponentCardForm() 

    {
        $form = $this->factory->create();
        
        $form->addText('num','Číslo:')
                        ->setRequired('Zadejte číslo')
                        ->setDefaultValue(1);
                
               
        $form->addSubmit('send', 'Uložit')
        ->setAttribute('class', 'btn btn-info btn-sm');   

       
        $form->onSuccess[] = [$this, 'processForm'];
        return $form;
    }

    public function processForm($form)
    {
        
        $this->onPeopleSave($this, $saveData);

    }
    
    public function render(){
       $this->template->render(__DIR__ .'/cardform.latte');
       bdump($this->people_id);
       //$this->template->render();
    }
}

/** rozhrannĂ­ pro generovanou tovĂˇrniÄŤku */
interface ICardFormFactory
{
    /** @return \CardForm */
    function create($dir,$people_id);
}
