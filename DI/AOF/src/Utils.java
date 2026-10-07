import java.util.Scanner;

public class Utils {
   public static Scanner sc = new Scanner(System.in);

    public static int readInt(String message){
        System.out.print(message);
        return sc.nextInt();
    }
    public static String readString(String message){
        System.out.print(message);
        return sc.next();
    }
}
