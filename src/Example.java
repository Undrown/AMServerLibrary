public class Example {
    public static void main(String[] args) {
        User user = Connector.performLoginRequest(111L);
        Connector.performPullRequest(user);
        System.out.println(user.data.get(0));
    }
}
