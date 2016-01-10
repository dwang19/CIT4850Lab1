<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        if (!isset($_GET['board'])) 
            echo  "<a href='http://localhost/CIT4850Lab1/?board=---------'> Start Game</a>"; 
        //if no board params exist then...
        //this creates a "Start Game" link at the top of page to initialize board parameters
        //if more time given, we can clean up the errors by isolating the game code
        

        $position = $_GET['board']; 
        $squares = str_split($position);
        //pulls the board paramters from the URL into an array
        
        $game = new Game($squares);
        $game->pick_move();
        //invoke the pick_move function which automatically selects the first available position in the array
        $game->display(); 
        //prepare game and set up the board visually
        
        if ($game->winner('x'))
            echo 'You win. Lucky guesses!';
        else if ($game->winner('o'))
            echo 'I win. Muahahahaha';
        else
            echo 'No winner yet, but you are losing.';
        //this is the main logic as the game progresses
        //primarily hinges on the win conditions set in the winner function
       
        ?> 
    </body>
</html>

<?php

class Game {
    
    var $position; 
    //initialize variables
    
    function __construct($squares) {
        $this->position = $squares;
    }
    //instantiate variables and set up constructors

    function winner($token) {
        $won = false;
        if (($this->position[0] == $token) &&
            ($this->position[1] == $token) &&
            ($this->position[2] == $token)) {
            $won = true;
        } else if
           (($this->position[3] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[5] == $token)) {
            $won = true;
        } else if
           (($this->position[6] == $token) &&
            ($this->position[7] == $token) &&
            ($this->position[8] == $token)) {
            $won = true;
        } else if
           (($this->position[0] == $token) &&
            ($this->position[3] == $token) &&
            ($this->position[6] == $token)) {
            $won = true;
        } else if
           (($this->position[1] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[7] == $token)) {
            $won = true;
        } else if
           (($this->position[2] == $token) &&
            ($this->position[5] == $token) &&
            ($this->position[8] == $token)) {
            $won = true;
        } else if
           (($this->position[0] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[8] == $token)) {
            $won = true;
        } else if
           (($this->position[2] == $token) &&
            ($this->position[4] == $token) &&
            ($this->position[6] == $token)) {
            $won = true;
        } 
        return $won;
    }
    //the winner function looks at all the possible win conditions
    //note the lack of a draw function (something to implement if more time given)
    
    
    function display() {
        echo 'You are playing Tic Tac Toe!';
        echo '<table cols="3" style="font-size:10em"; font-weight:"bold" border="1px solid black" width=400px height=400px >';
        echo '<tr>'; //open first row
        for ($pos=0; $pos<9; $pos++) {
            echo $this->show_cell($pos);
            if ($pos %3 == 2) echo '</tr><tr>'; //start new row for next square
        }
        echo '</tr>'; //close last row
        echo '</table>';
    }
    //echo messages and html elements to get presentation set up for the game
    //heavy use of tables and styling of tables to get the 3x3 grid used in tictactoe
    
    
    function show_cell($which) {
        $token = $this->position[$which];
        //deal with the easy case
        if ($token <> '-') return '<td>'.$token.'</td>';
        //now the hard case
        $this->newposition = $this->position;
        //copy the original
        $this->newposition[$which] = 'x'; 
        //this would be their move
        $move = implode($this->newposition); 
        //make a string from the board array
        $link = '?board='.$move; 
        //this is what we want the link to be
        //return a cell containing an anchor & showing a hyphen
        return '<td><a href="'.$link.'">-</a></td>';
    }
    
   function pick_move() {
            for($i=0;$i<8;$i++){
            //index i will look through the array
                if($this->position[$i] == '-'){
                //once the index is pointing at a position with a hyphen, then...
                    $this->position[$i] = 'o';
                    //replace the hyphen with AI's 'o' character
                    break;
                    } 
            }
   }
    //not the smartest AI as it is predictable, but creates an "interactive" feel so to speak
    
    
}
?>
























