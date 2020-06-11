import com.google.gson.Gson;

import java.io.IOException;
import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.time.Duration;
import java.util.Arrays;

public class Connector {
    private static final String webApi = "https://anmedia-server.000webhostapp.com/include/api.php";
    private static final HttpClient httpClient = HttpClient.newBuilder().build();
    private static final Gson gson = new Gson();

    public static User performLoginRequest(Long phone_num){
        String url = webApi + "?action=login&phone=" + phone_num.toString();
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .timeout(Duration.ofSeconds(10))
                .build();
        try {
            var response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());
            if (response.statusCode() != 200){
                System.out.println("Login error. request status:" + response.statusCode());
                System.out.println("Bad request?");
                return new User();
            }else if (response.body().contains("ERROR_")){
                System.out.println("Login error: " + response.body());
                return new User();
            }else {
                return gson.fromJson(response.body(), User.class);
            }
        } catch (InterruptedException e) {
            System.out.println("Login error: request interrupted");
        } catch (IOException e) {
            System.out.println("Login error: IO exception");
        }
        return new User();
    }

    public static void performPullRequest(User user){
        String url =webApi+"?action=get_data&id="+user.id;
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .timeout(Duration.ofSeconds(10))
                .build();
        try {
            var response = httpClient.send(request, HttpResponse.BodyHandlers.ofString());
            String responseBody = response.body();
            if (response.statusCode() != 200){
                System.out.println("Pull data error. request status:" + response.statusCode());
                System.out.println("Bad request?");
                return;
            }else if (responseBody.contains("ERROR_")){
                System.out.println("Pull data error: " + responseBody);
                return;
            }
            //parse json
            Entry[] data = gson.fromJson(response.body(), Entry[].class);
            user.data.addAll(Arrays.asList(data));
            user.data.forEach(entry -> entry.id = user.id);
        } catch (IOException e) {
            System.out.println("Pull data error: IO exception");
            e.printStackTrace();
        } catch (InterruptedException e) {
            System.out.println("Pull data error: request interrupted");
            e.printStackTrace();
        }
    }

    public static void performMassivePushRequest(User user){
        user.data.forEach(Connector::performPushRequest);
    }

    private static void performPushRequest(Entry entry){
        //need to do this in parallel
        if(entry.timeAdd == null){
            System.out.println("Adding...");
            performAddRequest(entry);
        }else if(entry.isModified){
            performUpdateRequest(entry);
        }
    }

    private static void performAddRequest(Entry entry){
        String url = webApi + "?action=add_data"+
                "&timeStart=" + entry.timeStart +
                "&timeEnd=" + entry.timeEnd +
                "&comment=" + entry.comment;
        HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create(url))
                .timeout(Duration.ofSeconds(10))
                .build();
        entry.state = Entry.RequestState.QUERIED;
        httpClient.sendAsync(request, HttpResponse.BodyHandlers.ofString())
        .thenApply(HttpResponse::body)
        .thenAccept(s -> {
            if (s.contains("ERROR_")) entry.state = Entry.RequestState.FAILED;
            else entry.state = Entry.RequestState.SUCCESS;
            System.out.println(s);
        })
        .join();
    }

    private static void performUpdateRequest(Entry entry){

    }
}
