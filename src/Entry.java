public class Entry {
    public String id;
    public Long timeAdd;
    public Long timeStart;
    public Long timeEnd;
    public String comment;
    public boolean isModified = false;
    public RequestState state = RequestState.INITIALIZED;

    @Override
    public String toString() {
        return "\nEntry{" +
                //"id: " + id +
                "time_add='" + timeAdd + '\'' +
                ", timeStart=" + timeStart +
                ", timeEnd=" + timeEnd +
                ", comment='" + comment + '\'' +
                '}';
    }

    enum RequestState{
        INITIALIZED,
        QUERIED,//request sent; waiting for response
        SUCCESS,
        FAILED
    }
}
