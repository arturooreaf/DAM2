package intento1;

import java.util.ArrayList;

public class Main {
    public static void main(String[] args) {
        ArrayList<User> users = new ArrayList<>();
        Admin admin1 = new Admin("Arturo", "hola");
        Guest guest1 = new Guest("fulano", "hola");
        Guest guest2 = new Guest("mengano", "hola");

        users.add(admin1);
        users.add(guest1);
        users.add(guest2);

        int option;
        boolean encontrado;
        System.out.println("Welcome ");
        while (true) {
            encontrado = false;
            System.out.println("1. Iniciar Sesion: \n" + "2. Cerrar sesion");
            option = Utils.readInt("Choice your Option: ");
            if (option == 2) {
                System.out.println("Cerrnando sesion...");
            } else if (option == 1) {
                String username = Utils.readLine("USERNAME: ");
                String password = Utils.readLine("PASSWORD: ");

                for (User user : users) {
                    if (user.verify(username, password)) {
                        user.actionByCategory(users);
                        encontrado = true;
                        break;
                    }

                }
                   if (!encontrado) {
                    System.out.print("Credenciales incorrectas");
                    break;
                }
            } else {
                System.out.println("Error al poner la option");
            }

        }

    }
}
