package intento1;

import java.util.ArrayList;

public class Guest extends User {
    public Guest(String username, String password) {
        super(username, password);
    }

    @Override
    public void actionByCategory(ArrayList<User> users) {
        System.out.println("Guest, " + this.getUsername());
        int option;

        while (true) {
            System.out.println("1. Ver user\n" + "2. Cerrar sesion");
            option = Utils.readInt("OPTION: ");

            if (option == 2) {
                System.out.println("Sesion has expired.. ");
                break;
            } else if (option == 1) {
                if (users.size() - 1 == 0) {
                    System.out.println("They arent any users..");
                } else {
                    for (User user : users) {
                        if (this.getUsername().equals(user.getUsername())) {
                            continue;
                        } else {
                            System.out.println(user.getUsername());
                        }

                    }
                }

            } else {
                System.out.println("Incorrect Option");
            }
        }
    }
}
