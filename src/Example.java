public class Example {
    public static void main(String[] args) {
        //логинимся
        //User - это твой Person
        //В нём такде есть массив со всеми данными
        User user = Connector.performLoginRequest(111L);
        //загружаем все данные с сервера
        Connector.performPullRequest(user);
        //создаём много интервалов (записей)
        for (int i = 0; i < 100; i++) {
            Entry entryToAdd = new Entry();
            entryToAdd.timeStart = 100L+i;
            entryToAdd.timeStart = 300L+i;
            entryToAdd.comment = "autotest" + i;
            entryToAdd.id = user.id;
            //добавляем к User
            user.data.add(entryToAdd);
        }
        //отправляем всё на сервер
        Connector.performMassivePushRequest(user);
        //System.out.println(user);
    }
}
