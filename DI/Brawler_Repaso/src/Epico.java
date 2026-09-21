public class Epico implements Brawler{
    private String  nombre;
    private  int vida;
    private final int  potencia = 500;

    public Epico(String nombre, int vida) {
        this.nombre = nombre;
        this.vida = vida;
    }

    @Override
    public void atacar() {
        System.out.println("Brawler atacando..");
    }

    @Override
    public void tirarUlti() {

    }


}
