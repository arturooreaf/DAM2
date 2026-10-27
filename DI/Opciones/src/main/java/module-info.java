module com.arturo.opciones {
    requires javafx.controls;
    requires javafx.fxml;

    requires org.controlsfx.controls;
    requires com.dlsc.formsfx;
    requires atlantafx.base;

    opens com.arturo.opciones to javafx.fxml;
    exports com.arturo.opciones;
}