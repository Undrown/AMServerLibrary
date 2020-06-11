import java.util.ArrayList;

public class User {
    String id;
    String name;
    Double salary;
    ArrayList<Entry> data = new ArrayList<>();

    public User(){
        id = "0";
        name = "";
        salary = 0D;
    }

    public void setData(String json){

    }
}
