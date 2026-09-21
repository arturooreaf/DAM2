public class Legendario implements Brawler {
    private String  nombre;
    private  int vida;
    private final int  potencia = 1000;

    public Legendario(String nombre, int vida) {
        this.nombre = nombre;
        this.vida = vida;
    }

    @Override
    public void atacar() {
        System.out.println("Brawler atacando");
    }

    @Override
    public void tirarUlti() {

    }


}
