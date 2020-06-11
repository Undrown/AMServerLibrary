public class Entry {
    //public Integer eid;
    public Long timeAdd;
    public Long timeStart;
    public Long timeEnd;
    public String comment;

    @Override
    public String toString() {
        return "\nEntry{" +
                "time_add='" + timeAdd + '\'' +
                ", timeStart=" + timeStart +
                ", timeEnd=" + timeEnd +
                ", comment='" + comment + '\'' +
                '}';
    }
}
