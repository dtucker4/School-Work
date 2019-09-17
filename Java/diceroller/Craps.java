
package diceroller;

import javax.swing.JOptionPane;
public class Craps {
    
    /**
     *
     */
    public static int playerSum, compSum;
    
    public static void main(String args[]){
    TwoDice player = new TwoDice();
    TwoDice computerPlayer = new TwoDice();    
    
    playerSum = player.rollDice();
    compSum = computerPlayer.rollDice();
    System.out.printf("Testing p1Sum: %d\n", playerSum);
    System.out.printf("Testing compSum: %d\n", compSum);
    
    if(playerSum > compSum || player.isMatching(player.die1, player.die2)){
        JOptionPane.showMessageDialog(null, "player rolled: "+ player.die1 + 
                " and " + player.die2 + " for a total of: " + playerSum +
                "\n\nThe computer rolled: "+ computerPlayer.die1 + " and a " + computerPlayer.die2 
                +" for a total of: "+ compSum + "\n\nYou Win!\n");
    }else if(player.isSnakeEyes(player.die1, player.die2)== true &&
            computerPlayer.isSnakeEyes(computerPlayer.die1, computerPlayer.die2)== true){
        JOptionPane.showMessageDialog(null, "Player rolled: " + player.die1 + 
                " and " + player.die2 + "for a total of: " + playerSum +
                "\n\nComputer rolled: "+ computerPlayer.die1 + " and a " + computerPlayer.die2 
                +" for a total of: "+ compSum + "\n\nIts a draw\n");
    }
    else{
    JOptionPane.showMessageDialog(null, "Player rolled: "+ player.die1 + 
                " and " + player.die2 + " for a total of: " + playerSum +
                "\n\nComputer rolled: "+ computerPlayer.die1 + " and a " + computerPlayer.die2 
                +" for a total of: "+ compSum +"\n\nYou lose\n");
    }
}
}