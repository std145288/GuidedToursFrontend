/*Έλεγχος πεδίων φόρμας*/
function validateForm() {
    /*Έλεγχος αν το πεδίο όνομα είναι συμπληρωμένο*/
    var namef = document.forms["frmReg"]["UserFirstNameField"].value;
    if (namef == "") {
        alert("Το πεδίο όνομα είναι υποχρεωτικό");
        return false;
    }

    /*Έλεγχος αν το πεδίο επώνυμο είναι συμπληρωμένο*/
    var namel = document.forms["frmReg"]["UserLastNameField"].value;
    if (namel == "") {
        alert("Το πεδίο επώνυμο είναι υποχρεωτικό");
        return false;
    }

    /*Έλεγχος αν το πεδίο email είναι συμπληρωμένο σωστά συμπληρωμένο*/
    var eml = document.forms["frmReg"]["UserEmailField"].value;
    if (eml == "") {
        alert("Το πεδίο email είναι υποχρεωτικό");
        return false;
    }

    var emailFilter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if (!emailFilter.test(eml)) {
            alert('Πρέπει να εισάγετε μια σωστή email διεύθυνση');
        return false;
    }

    /*Έλεγχος αν το πεδίο password είναι συμπληρωμένο*/
    var pswd = document.forms["frmReg"]["UserPasswordField"].value;
    if (pswd == "") {
        alert("Το πεδίο password είναι υποχρεωτικό");
        return false;
    }

    /*Έλεγχος αν το πεδίο reenter password είναι συμπληρωμένο και σωστά συμπληρωμένο*/
    var rpswd = document.forms["frmReg"]["ReenterUserPasswordField"].value;
    /*Έλεγχος αν το password περιέχει 8 χαρακτήρες*/
    if (pswd.length<8){
        /*Αν το password δεν περιέχει 8 χαρακτήρες θα πρέπει να επαναεισαχθεί με 8 χαρακτήρες ή να ταυτίζεται με το πεδίο επιβεβαίωσης*/
        if (rpswd == "") {
            alert("Πρέπει υποχρεωτικά να επανα-εισάγεται το password, αλιώς χρησιμοποιείστε τουλάχιστον 8 χαρακτήρες για το password");
            return false;
        /*Αν το password δεν περιέχει 8 χαρακτήρες και το πεδίο επιβεβαίωσης δεν ταυτίζεται με το password*/
        }else{
             if(rpswd !=pswd){
                 alert("Δεν έχετε επανα-εισάγει σωστά το password");
                return false;
            }
        }
    }
};