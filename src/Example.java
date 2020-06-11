public class Example {
    public static void main(String[] args) {
        User user = Connector.performLoginRequest(111L);
        Connector.performPullRequest(user);
        Entry entryToAdd = new Entry();
        entryToAdd.timeStart = 100L;
        entryToAdd.timeStart = 300L;
        entryToAdd.comment = "autotest";
        entryToAdd.id = user.id;
        user.data.add(entryToAdd);
        Connector.performMassivePushRequest(user);
        //System.out.println(user);
    }
}
