package com.arturo.altum;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

import java.net.URL;
import java.util.ResourceBundle;

public class MainController implements Initializable {

    @FXML private Label labelTitle, labelResult;
    @FXML private TextField textfieldNumber1, textfieldNumber2;
    @FXML private ComboBox<Option> comboboxOperation;
    @FXML private Button buttonCalculate;

    private void checkValues(){
        boolean validCombo = comboboxOperation.getValue() != null;
        boolean validTextField = false;

        try {
            Integer.parseInt(textfieldNumber1.getText());
            Integer.parseInt(textfieldNumber2.getText());

            validTextField = true;
        }catch (Exception _ ){

        }
        buttonCalculate.setDisable(!(validCombo && validTextField));
    }
    @FXML
    private void onCalculate() {
        int number1 = Integer.parseInt(textfieldNumber1.getText()) ;
        int number2 = Integer.parseInt(textfieldNumber2.getText()) ;
        String operation = comboboxOperation.getValue().getKey();

        int resultado = switch (operation){
            case "add"            -> number1 + number2;
            case "substract"      -> number1 - number2;
            case "multiply"       -> number1 * number2;
            case "divide"         -> number1 / number2;
            default               ->  0;
        };

        labelResult.setText(String.valueOf(resultado));
    }
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        Option optionAdd = new Option("add", "Sumar");
        Option optionSubstract = new Option("substract", "Restar");
        Option optionMultiply = new Option("multiply", "Multiplicar");
        Option optionDivide = new Option("divide", "Dividir");
        labelTitle.requestFocus();

        comboboxOperation.getItems().addAll(optionAdd,optionSubstract,optionMultiply,optionDivide);

        //Escuchadores pendientes de cambios
        textfieldNumber1.textProperty().addListener(_ -> checkValues());
        textfieldNumber2.textProperty().addListener(_ -> checkValues());
        comboboxOperation.valueProperty().addListener(_->checkValues());


    }
}