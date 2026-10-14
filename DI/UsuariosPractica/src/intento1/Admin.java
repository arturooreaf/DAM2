package intento1;

import java.util.ArrayList;

public class Admin extends User {
    public Admin(String username, String password) {
        super(username, password);
    }

    @Override
    public void actionByCategory(ArrayList<User> users) {
        System.out.println("WELCOME ADMIN, " + this.getUsername());
        while(true){
            System.out.println("1. Ver usuarios\n" + "2. Modificar users\n" + "3. Cerrar sesion");

            int option = Utils.readInt("OPTION: ");
            if(option == 3){
                System.out.println("Cerrando sesion...");
                break;
            } else if(option == 1){
                if(users.size()-1==0){

                    System.out.println("No hay usuarios");
                }else{
                    for(User user : users){
                        if(!this.getUsername().equals(user.getUsername())){
                            System.out.println(user.getUsername());
                        }
                    }
                }
            } else if(option == 2){
                String username= Utils.readLine("USERNAME: ");
                String password = Utils.readLine("PASWWORD: ");
                Guest guest1 = new Guest(username, password);

                users.add(guest1);

            }else{
                System.out.println("Error al elegir la opcion");
            }
        }

    }
}
