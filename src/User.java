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

    @Override
    public String toString() {
        StringBuilder data_b = new StringBuilder();
        data.forEach(entry -> data_b.append(entry.toString()));
        String data_str = data_b.toString();
        return "User " +
                "id='" + id + '\'' +
                ", name='" + name + '\'' +
                ", salary=" + salary +
                "\nData: " + data_str;
    }
}
