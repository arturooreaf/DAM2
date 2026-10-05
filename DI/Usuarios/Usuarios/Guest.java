package examen;

import java.util.ArrayList;

public class Guest extends User {

    public Guest(String username, String password) {
        super(username, password);
    }

    @Override
    public void actionByUserType(ArrayList<User> users){
        //Mensaje de bienvenida
        System.out.printf("\n---------------\nBienvenido, %s\n", this.getUsername());

        int opcion;

        //Por siempre
        while(true){
            //Muestra un menú y pide una opción al usuario
            System.out.println("1. Ver usuarios\n2. Cerrar sesión");
            opcion = Utils.readInteger("OPCIÓN: ");

            //Si la opción es 2, cierra el usuario
            if(opcion == 2){
                break;

            //Si la opción es 1, imprime los usuarios
            } else if(opcion == 1){
                System.out.println();

                //Si el números (users.size()) menos el propio usuario (-1) es 0, es que no hay usuarios
                if(users.size() - 1 == 0){
                    System.out.println("Todavía no hay usuarios...");
                } else {
                    //Para cada usuario de los usuarios
                    for(User user : users){
                        //Imprime el usuario siempre que no sea el propio de la clase
                        if(!user.getUsername().equals(this.getUsername())){
                            System.out.printf("- %s\n", user.getUsername());
                        }
                    }
                }

            } else {
                System.out.println("Opción incorrecta\n");
            }

            System.out.println();
        }
    }
}
