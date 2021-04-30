
/**
 * SalInterface class to define GUI interface and handle event
 *
 * @author (Sunwit Petchoo)
 * @version (22/05/2019)
 */
import java.awt.*;
import javax.swing.*;
import javax.swing.border.Border;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class SalInterface extends JFrame 
{
    //constant for frame size
    private final int WIDTH = 600;
    private final int HEIGHT = 300;
    
    //variables to manage game play
    private final int TOTAL_SQUARES = 30;
    private int currentPlayer = 0;;
    private int pyPosition = 0; 
    private int pyPositionTmp = 0;
    private int comPosition = 0;
    private int comPositionTmp = 0;
    boolean extraMove = false;
    Die die = new Die();
    private int[] ladderStarts = {4, 12}; 
    private int[] ladderEnds = {14, 22}; 
    private int[] snakeStarts = {20, 16}; 
    private int[] snakeEnds =   {7,  5};
    
    //vaiables for interface 
    private JPanel consolePanel;
    private JPanel boardPanel;
    private JPanel gamePanel;
    private Container contentPane;
    Border blackline = BorderFactory.createLineBorder(Color.black);
    JButton [] button = new JButton[TOTAL_SQUARES];
    JButton start = new JButton("START !!");
    JLabel gameMessage = new JLabel("Welcome !!!!");
    JButton rollButton = new JButton("ROLL");
    JLabel gameMessage2 = new JLabel();
    JLabel dieResultB = new JLabel("");
    JButton player = new JButton();
    JButton computer = new JButton();
     
    
    /**
     * Constructor for SalInterface 
     */
    public SalInterface()
    {
        super("Snake and Ladder Game !!!");
        makeFrame();
    }

    /**
     * method for creating frame
     */
    public void makeFrame()
    {
        contentPane = getContentPane();
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        gamePanel = new JPanel();
        gamePanel.setLayout(new FlowLayout());
        makeConsole();
        makeBoard();
        gamePanel.add(consolePanel);
        gamePanel.add(boardPanel);
        
        //start event handler
        start.addActionListener(
            new ActionListener() {
                public void actionPerformed(ActionEvent e) 
                {
                    start.setEnabled(false);
                    gameMessage.setText("Game Start !!  Roll the die to decide 1st player");
                    enableRollButton(true);
                }
            }
        );
        
        //restart event handler
        JButton reStart = new JButton("New Game");
        reStart.addActionListener(
            new ActionListener() {
                public void actionPerformed(ActionEvent e) 
                {
                    reStart();
                }
            }
        );
        
        //exit event handler
        JButton exit = new JButton("T_T Exit T_T");
        exit.addActionListener(
            new ActionListener() {
                public void actionPerformed(ActionEvent e) 
                {
                    System.exit(0);
                }
            }
        );
        
        gamePanel.add(start);
        gamePanel.add(reStart);
        gamePanel.add(exit);
        gamePanel.setBorder(blackline);
        contentPane.add(gamePanel);
        setSize(WIDTH, HEIGHT);
        setVisible(true);
    }
    
    /**
     * method for creating game information and roll button
     */
    public void makeConsole()
    {
        //initial panel and layout
        consolePanel = new JPanel();
        consolePanel.setBorder(blackline);
        JPanel consoleIn = new JPanel();
        consoleIn.setLayout(new BorderLayout());
        JPanel infoPanel = new JPanel();
        BoxLayout layout = new BoxLayout(infoPanel, BoxLayout.Y_AXIS);
        infoPanel.setLayout(layout);
        JPanel inPanel = new JPanel();
        JPanel inPanel2 = new JPanel();
        JPanel inPanel3 = new JPanel();
        JPanel inPanel4 = new JPanel();
        JPanel inPanel5 = new JPanel();
        
        //ladder and snake information
        JButton firstLadder = new JButton();
        firstLadder.setBackground(Color.orange);
        JLabel firstLadderInfo = new JLabel("Ladder position go up 4 --> 14");
        JButton secondLadder = new JButton();
        secondLadder.setBackground(Color.green);
        JLabel secondLadderInfo = new JLabel("Ladder position go up 12 --> 22");
        JButton snakeH1 = new JButton();
        snakeH1.setBackground(Color.red);
        JLabel snakeH1Info = new JLabel("Snake head silde down 20 --> 7");
        JButton snakeH2 = new JButton();
        snakeH2.setBackground(Color.pink);
        JLabel snakeH2Info = new JLabel("Snake head silde down 16 --> 5");
        
        inPanel.add(firstLadder);
        inPanel.add(firstLadderInfo);
        inPanel2.add(secondLadder);
        inPanel2.add(secondLadderInfo);
        inPanel3.add(snakeH1);
        inPanel3.add(snakeH1Info);
        inPanel4.add(snakeH2);
        inPanel4.add(snakeH2Info);
        infoPanel.add(inPanel);
        infoPanel.add(inPanel2);
        infoPanel.add(inPanel3);
        infoPanel.add(inPanel4);
        
        JPanel iconPanel = new JPanel();
        iconPanel.setLayout(new FlowLayout());
        JPanel msgPanel = new JPanel();
        BoxLayout msgLayout = new BoxLayout(msgPanel, BoxLayout.Y_AXIS);
        
        //game message
        msgPanel.setLayout(msgLayout);
        msgPanel.add(gameMessage);
        msgPanel.add(gameMessage2);
        consoleIn.add(msgPanel, BorderLayout.NORTH);
        
        //Player info.
        JLabel playerLabel = new JLabel("YOU");
        JLabel comLabel = new JLabel("COM");
        iconPanel.add(player);
        iconPanel.add(playerLabel);
        iconPanel.add(computer);
        iconPanel.add(comLabel);
        consoleIn.add(iconPanel,BorderLayout.WEST);
        
        //Die info.
        JLabel dieResult = new JLabel("Roll result =   ");
        dieResultB.setBackground(Color.CYAN);
        enableRollButton(false);
        
        // roll event handler 
        rollButton.addActionListener(
            new ActionListener() {
                public void actionPerformed(ActionEvent e) 
                {
                    if(currentPlayer == 0)
                    {
                        //for first roll
                        rollActionForStart();
                    }else
                    {
                        rollForPlay();
                    }
                }
            }
        );
        
        dieResultB.setOpaque(true);
        inPanel5.add(rollButton);
        inPanel5.add(dieResult);
        inPanel5.add(dieResultB);
        infoPanel.add(inPanel5);
        consoleIn.add(infoPanel,BorderLayout.SOUTH);
        consolePanel.add(consoleIn);
       
    }
    
    /**
     * method for creating board
     */
    public void makeBoard()
    {
        //initial panel and layout 
         boardPanel = new JPanel();
         boardPanel.setBorder(blackline);
         boardPanel.setLayout(new GridLayout(5,6));
         boardPanel.setComponentOrientation(ComponentOrientation.RIGHT_TO_LEFT);
         
         //create button for board and handle action
         int id=0;
         for(int i = 0; i < TOTAL_SQUARES; i++)
        {
            id = i+1;
            button[i] = new JButton("" +id);
            button[i].addActionListener(
            new ActionListener() {
                public void actionPerformed(ActionEvent e) 
                {
                    playerMove(e);
                }
            }
        );
            //disable all squares before start
            button[i].setEnabled(false);
            
            //add color for snake and ladder
            if(i == 3 || i == 13)
            {
                 button[i].setBackground(Color.orange);
            }
            if(i == 11 || i == 21)
            {
                 button[i].setBackground(Color.green);
            }
            if(i == 19 || i == 6)
            {
                 button[i].setBackground(Color.red);
            }
            if(i == 15 || i == 4)
            {
                 button[i].setBackground(Color.pink);
            }
        }
        
        //add to panel
        for(int i =29; i>=0; i--)
        {
            boardPanel.add(button[i]);
        }

    }
    
    /**
     * method to decide first player
     */
    public void rollActionForStart()
    {
        int playerFace,comFace; 
        //computer and player make roll
        playerFace = die.roll();
        comFace = die.roll();
        dieResultB.setText(" "+playerFace+" ");
        changeMsg(gameMessage,"you got "+playerFace);
        dieResultB.setText(" "+comFace+" ");
        changeMsg(gameMessage2,"Computer got "+comFace);
        
        //player start first
        if(playerFace > comFace)
        {
            currentPlayer = 1;
            changeMsg(gameMessage,"You move first");
            changeMsg(gameMessage2,"Roll the die to move");
            enableBoard();
            player.setBackground(Color.blue);
            
        }else if(playerFace < comFace)
        {
            //com start first
            currentPlayer = 2;
            changeMsg(gameMessage,"Computer move first");
            changeMsg(gameMessage2,"Roll the die for computer");
            computer.setBackground(Color.yellow);
            enableBoard();
            
        }else
        {
            //in case same result
            rollActionForStart();
        }
        
    }
    
    /**
     * method to decide first player
     */
    public void changeMsg(JLabel id, String msg)
    {
        id.setText(msg);
    }
    
    /**
     * method to roll the die and update position
     */
    public void rollForPlay()
    {
            rollButton.setEnabled(true);
            int numFace = die.roll();
            
            //extra move for face 6
            if(numFace == 6)
            {
                extraMove = true;
            }else
            {
                extraMove = false;
            }
            
            int targetSquare;
            //get current position and cal for next move
            if(currentPlayer == 1)
            {
                targetSquare = pyPositionTmp + numFace;
            }else
            {
                targetSquare = comPositionTmp + numFace;
            }
            
            //update message and check over max square
            if(targetSquare <= TOTAL_SQUARES)
            {
                
                dieResultB.setText(""+numFace);
                changeMsg(gameMessage,"Move to number >>>"+targetSquare);
                changeMsg(gameMessage2,"");
                rollButton.setEnabled(false);
                
                //Make move 
                if(currentPlayer != 1)
                {
                    comAutoMove(comPosition,numFace);
                }else
                {
                    pyPosition = pyPosition+numFace;
                }
                
            }else
            {
                //alert message and change player
                JOptionPane.showMessageDialog(null, "Too high !!!!  Skip this turn");
                swapPlayer(currentPlayer);
            }
    }
    
    /**
     * enable all button on board
     */
    public void enableBoard()
    {
        for(int i = 0; i < TOTAL_SQUARES; i++)
        {
            button[i].setEnabled(true);
        }
    }
    
    /**
     * dis or enable roll button
     */
    public void enableRollButton(boolean enable)
    {
        rollButton.setEnabled(enable);
    }
    
    /**
     * Method to make move for computer turn
     */
    public void comAutoMove(int startPos, int move)
    {
        //Move 
        int moveIndex = (startPos+move) - 1;
        comPosition = startPos+move;
        button[moveIndex].setBackground(Color.yellow);
        
        //change color after move
        if(comPositionTmp !=0 )
        {
                int oldIndex = comPositionTmp - 1;
                    //handle com and player in same position
                    if(pyPositionTmp == comPositionTmp)
                    {
                            button[oldIndex].setBackground(Color.BLUE);
                    }else
                    {
                        //update board to default
                        for(int i=0;i<button.length;i++)
                        {
                            if(i == oldIndex)
                            {
                                if(i==3 || i==13)
                                {
                                    button[oldIndex].setBackground(Color.ORANGE);
                                }else if(i==11 || i==21)
                                {
                                    button[oldIndex].setBackground(Color.GREEN);
                                }
                                else if(i==19 || i==6)
                                {
                                    button[oldIndex].setBackground(Color.RED);
                                }
                                else if(i==15 || i==4)
                                {
                                    button[oldIndex].setBackground(Color.PINK);
                                }else
                                {
                                    button[oldIndex].setBackground(null);
                                }
                            }
                        }
                    }
        }
                    
                    comPositionTmp = comPosition;
                    //check bottom and snake head
                    BottomLadderFall(comPosition,currentPlayer);
                    snakeHeadFall(comPosition,currentPlayer);
                    //win or not 
                    boolean isWin = checkWinner(comPositionTmp, currentPlayer);
                    
                    if(!isWin)
                    {
                        //not swap in case extra move
                        if(!extraMove)
                        {
                            swapPlayer(currentPlayer);
                        }else
                        {
                            changeMsg(gameMessage, "Extra move for 6 value!!!");
                            changeMsg(gameMessage2, "Roll and move second time  !!!");
                            rollButton.setEnabled(true);
                        }
                    }
                    
    }
    
    /**
     * Method to swap player
     */
    public void swapPlayer(int sPlayer)
    {
        if(sPlayer == 1)
        {
            currentPlayer = 2;
            computer.setBackground(Color.YELLOW);
            player.setBackground(null);
            changeMsg(gameMessage,"Computer turn");
            changeMsg(gameMessage2,"Roll the die for computer");
            rollButton.setEnabled(true);
        }else
        {
            currentPlayer = 1;
            computer.setBackground(null);
            player.setBackground(Color.BLUE);
            changeMsg(gameMessage,"Your turn");
            changeMsg(gameMessage2,"Roll the die to move");
            rollButton.setEnabled(true);
        }
    }
    
    /**
     * Method to make move for player
     */
    public void playerMove(ActionEvent e)
    {
        if(!rollButton.isEnabled() && currentPlayer != 2 )
        {
            int buttonPos = Integer.parseInt(e.getActionCommand());
            int moveIndex = buttonPos - 1;
            //check clicked button correct or not
            if(buttonPos != pyPosition)
            {
                changeMsg(gameMessage,"Worng move!! Please go to "+pyPosition);
            }else
            {
                //Move
                button[moveIndex].setBackground(Color.BLUE);
                if(pyPositionTmp!=0)
                {
                    int oldIndex = pyPositionTmp - 1;
                    //handle com and player in same square
                    if(pyPositionTmp ==comPositionTmp)
                    {
                        button[oldIndex].setBackground(Color.YELLOW);
                    }else
                    {
                        //update board to default
                        for(int i=0;i<button.length;i++)
                        {
                            if(i == oldIndex)
                            {
                                if(i==3 || i==13)
                                {
                                    button[oldIndex].setBackground(Color.ORANGE);
                                }else if(i==11 || i==21)
                                {
                                    button[oldIndex].setBackground(Color.GREEN);
                                }
                                else if(i==19 || i==6)
                                {
                                    button[oldIndex].setBackground(Color.RED);
                                }
                                else if(i==15 || i==4)
                                {
                                    button[oldIndex].setBackground(Color.PINK);
                                }else
                                {
                                    button[oldIndex].setBackground(null);
                                }
                            }
                        }
                    }
                   
                }
                pyPositionTmp = pyPosition;
                //check bottom and snake head
                BottomLadderFall(pyPosition,currentPlayer);
                snakeHeadFall(pyPosition,currentPlayer);
                //win or not
                boolean isWin = checkWinner(pyPositionTmp, currentPlayer);
                
                if(!isWin)
                {
                    // not swap for extra move
                    if(!extraMove && !isWin)
                    {
                        swapPlayer(currentPlayer);
                    }else
                    {   
                        changeMsg(gameMessage, "Extra move for 6 value!!!");
                        changeMsg(gameMessage2, "Roll and move second time  !!!");
                        rollButton.setEnabled(true);
                    }
                }
                
            }
        }
    }
    
    /**
     * Method to check and move for botton ladder
     */
    public void BottomLadderFall(int target,int currentPlayer)
    {
        boolean isBottom = false;
        
        for(int i=0;i<ladderStarts.length;i++)
        {
            if(target == ladderStarts[i])
            {
                int moveTo = ladderEnds[i];
                int moveToIndex = moveTo - 1;
                changeMsg(gameMessage,"Ladder bottom");
                changeMsg(gameMessage2,"Go up to "+moveTo);
                //move up to top ladder 
                if(currentPlayer == 1)
                {
                    pyPosition = moveTo;
                    button[moveToIndex].setBackground(Color.BLUE);
                    pyPositionTmp = pyPosition;
                }else
                {
                    comPosition = moveTo;
                    button[moveToIndex].setBackground(Color.YELLOW);
                    comPositionTmp = comPosition;
                }
                //change color back 
                if(ladderStarts[i] == 4)
                {
                    button[target-1].setBackground(Color.ORANGE);
                }
                    
                if(ladderStarts[i] == 12)
                {
                    button[target-1].setBackground(Color.GREEN);
                }
            }
        }
    }
    
    /**
     * Method to check and move for snake head
     */
    public void snakeHeadFall(int target,int currentPlayer)
    {
        boolean isHead = false;
        
        for(int i=0;i<snakeStarts.length;i++)
        {
            if(target == snakeStarts[i])
            {
                int moveTo = snakeEnds[i];
                int moveToIndex = moveTo - 1;
                changeMsg(gameMessage,"Snake Head!!");
                changeMsg(gameMessage2,"Slide down to "+moveTo);
                int oldIndex = target-1;
                // slide down and change color back
                if(currentPlayer == 1)
                {
                    pyPosition = moveTo;
                    button[moveToIndex].setBackground(Color.BLUE);
                    pyPositionTmp = pyPosition;
                }else
                {
                    comPosition = moveTo;
                    button[moveToIndex].setBackground(Color.YELLOW);
                    comPositionTmp = comPosition;
                }
                    
                if(snakeStarts[i] == 20)
                {
                    button[oldIndex].setBackground(Color.RED);
                }
                    
                if(snakeStarts[i] == 16)
                {
                    button[oldIndex].setBackground(Color.PINK);
                }
            }
        }
    }
    
    /**
     * Method to restart game 
     */
    public void reStart()
    {
        //Change all game control variable to first state
        currentPlayer = 0;;
        pyPosition = 0; 
        pyPositionTmp = 0;
        comPosition = 0;
        comPositionTmp = 0;
        enableRollButton(false);
        start.setEnabled(true);
        player.setBackground(null);
        computer.setBackground(null);
        changeMsg(gameMessage, "Welcome !!!!");
        changeMsg(gameMessage2, "");
        dieResultB.setText("");
        
        //update board to default
        for(int i=0;i<button.length;i++)
        {
                                
            if(i==3 || i==13)
            {
                button[i].setBackground(Color.ORANGE);
            }else if(i==11 || i==21)
            {
                button[i].setBackground(Color.GREEN);
            }
            else if(i==19 || i==6)
            {
                button[i].setBackground(Color.RED);
            }
            else if(i==15 || i==4)
            {
                button[i].setBackground(Color.PINK);
            }else
            {
                button[i].setBackground(null);
            }                        
        }
    }
    
    /**
     * Method to check winner and deplay message 
     */
    public boolean checkWinner(int des,int playerOrCom)
    {
        boolean isWin = false;
        
        if(des == TOTAL_SQUARES)
        {
            String winMsg ="";
            
            if(playerOrCom == 1)
            {
                winMsg = "Congratulation !!! You win !!! ";
            }else
            {
                winMsg = "T_T Computer win T_T";
            }
            
            //alert message
            JOptionPane.showMessageDialog(null, winMsg);
            //restart game 
            reStart();
            isWin = true;
        }
        return isWin;
    }
    
}
