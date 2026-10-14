module com.arturo.tema2 {
    requires javafx.controls;
    requires javafx.fxml;

    requires org.controlsfx.controls;
    requires com.dlsc.formsfx;
    requires jdk.compiler;

    opens com.arturo.tema2 to javafx.fxml;
    exports com.arturo.tema2;
}