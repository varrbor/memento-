<!--https://sourcemaking.com/design_patterns/memento/php-->

<?php
/**
 * Memento pattern example
 *
 * @copypaste by Bohdan Varvarych from somewhere in net
 * @purpose is to expose to Otakoyi team
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

interface Imemento {
    public function getSavedState();

}

class Memento implements Imemento
{
    protected $state;
    public function __construct($state)
    {
        $this->state = $state;
    }
    public function getSavedState()
    {
        return $this->state;
    }
}

class Originator
{
    protected $state = '';
    public function setState($state)
    {
        echo 'Originator: Setting state to: ' . $state . "<br/>";
        $this->state = $state;
    }
    public function saveToMemento()
    {
        return new Memento($this->state);
    }
    public function restoreFromMemento(Memento $memento)
    {
        $this->state = $memento->getSavedState();
        echo "Originator: State after restoring from Memento: " . $this->state . PHP_EOL;
    }
}

class Caretaker
{
    public function doIt($index)
    {
        $savedStates = array();
        $originator = new Originator();
        $originator->setState('StateOne');
        $savedStates[] = $originator->saveToMemento();
        $originator->setState('StateTwo');
        $savedStates[] = $originator->saveToMemento();
        $originator->setState('StateThree');
        $savedStates[] = $originator->saveToMemento();
//        echo '<pre>';
//        var_dump($savedStates);
//        echo '</pre>';
//        die();
        $originator->restoreFromMemento($savedStates[$index]);
    }
}
$careTaker = new Caretaker();
$careTaker->doIt(2);