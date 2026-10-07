import java.util.ArrayList;

public class Furgoneta extends Vehiculo {
    private String transporte;

    public Furgoneta(String marca, int kilometro, String transporte) {
        super(marca, kilometro);
        this.transporte = transporte;
    }

    @Override
    public String toString() {
        return "Furgoneta{" +
                "transporta comida ='" + transporte + '\'' +
                '}';
    }


    }

