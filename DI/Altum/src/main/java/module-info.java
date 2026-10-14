module com.arturo.altum {
    requires javafx.controls;
    requires javafx.fxml;

    requires org.controlsfx.controls;
    requires com.dlsc.formsfx;

    opens com.arturo.altum to javafx.fxml;
    exports com.arturo.altum;
}