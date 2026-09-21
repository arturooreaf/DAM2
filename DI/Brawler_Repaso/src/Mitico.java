public class Mitico implements Brawler {
    private String  nombre;
    private  int vida;
    private final int  potencia = 500;

    public Mitico(String nombre, int vida) {
        this.nombre = nombre;
        this.vida = vida;
    }

    @Override
    public void atacar() {
        System.out.println("Brawler Atacando");
    }

    @Override
    public void tirarUlti() {

    }


}
