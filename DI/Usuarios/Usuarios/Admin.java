package examen;

import java.util.ArrayList;

public class Admin extends User {

    public Admin(String username, String password) {
        super(username, password);
    }

    @Override
    public void actionByUserType(ArrayList<User> users) {
        //Mensaje de bienvenida
        System.out.printf("\n---------------\nBienvenido, %s\n", this.getUsername());

        int opcion;
        boolean userFound;

        //Por siempre
        while(true){
            userFound = false;

            //Muestra un menú y pide una opción al usuario
            System.out.println("1. Ver usuarios\n2. Crear usuario\n3. Cerrar sesión");
            opcion = Utils.readInteger("OPCIÓN: ");

            //Si la opción es 2, cierra el usuario
            if(opcion == 3){
                break;

                //Si la opción es 1, imprime los usuarios
            } else if(opcion == 1) {
                System.out.println();

                //Si el números (users.size()) menos el propio usuario (-1) es 0, es que no hay usuarios
                if (users.size() - 1 == 0) {
                    System.out.println("Todavía no hay usuarios...");
                } else {
                    //Para cada usuario de los usuarios
                    for (User user : users) {
                        //Imprime el usuario siempre que no sea el propio de la clase
                        if (!user.getUsername().equals(this.getUsername())) {
                            System.out.printf("- %s\n", user.getUsername());
                        }
                    }
                }

            //Si la opción es 2, crea un usuario
            } else if(opcion == 2){
                //Se pide unos datos de un nuevo usuario
                String newUsername = Utils.readString("NUEVO NOMBRE: ");
                String newPassword = Utils.readString("CONTRASEÑA: ");

                //Para cada usuario de los usuarios
                for(User user : users){
                    //Si el nombre de usuario es equivalente al nuevo
                    if(user.getUsername().equals(newUsername)){
                        //Quiere decir que está repetido, se activa el trigger
                        System.out.println("El usuario ya existe...");
                        userFound = true;
                        break;
                    }
                }

                //Si el trigger está desactivado, ese nombre no está utilizado todavía
                if(!userFound){
                    Guest guest = new Guest(newUsername, newPassword);
                    users.add(guest);
                    System.out.println("Usuario creado correctamente...");
                }

            } else {
                System.out.println("Opción incorrecta\n");
            }

            System.out.println();
        }
    }
}
