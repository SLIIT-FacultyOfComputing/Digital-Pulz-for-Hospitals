package core.classes.clinic;
import java.util.Date;

public class diabetic_graph {
	
	private int graph_id;
	private clinic_visit  clinic_visit_id;
	private int blood_glucose_level;
	private Date date;
	
	
	public int getGraph_id() {
		return graph_id;
	}
	public void setGraph_id(int graph_id) {
		this.graph_id = graph_id;
	}
	public clinic_visit getClinic_visit_id() {
		return clinic_visit_id;
	}
	public void setClinic_visit_id(clinic_visit clinic_visit_id) {
		this.clinic_visit_id = clinic_visit_id;
	}
	public int getBlood_glucose_level() {
		return blood_glucose_level;
	}
	public void setBlood_glucose_level(int blood_glucose_level) {
		this.blood_glucose_level = blood_glucose_level;
	}
	public Date getDate() {
		return date;
	}
	public void setDate(Date date) {
		this.date = date;
	}
	
		
}
