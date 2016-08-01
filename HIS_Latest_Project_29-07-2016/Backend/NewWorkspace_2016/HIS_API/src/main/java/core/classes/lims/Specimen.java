package core.classes.lims;

import java.util.Date;
import java.util.HashSet;
import java.util.Set;

import core.classes.api.user.AdminUser;

public class Specimen {

	private int specimen_ID;
	private Date specimen_CollectedDate;
	private Date specimen_ReceivedDate;
	private String remarks;
	private Date specimen_DeliveredDate;
	private Date specimen_stored_destroyed_date;
	private AdminUser fSpecimen_CollectedBy;
	private AdminUser fSpecimen_ReceivededBy;
	private AdminUser fSpecimen_DeliveredBy;
	private SpecimenRetentionType fRetentionType_ID;
	private SpecimenType fSpecimentType_ID;
	private LabTestRequest flabtestrequest_ID;
	private String stored_location;
	private String stored_or_destroyed;
	
	public Date getSpecimen_stored_destroyed_date() {
		return specimen_stored_destroyed_date;
	}
	public void setSpecimen_stored_destroyed_date(
			Date specimen_stored_destroyed_date) {
		this.specimen_stored_destroyed_date = specimen_stored_destroyed_date;
	}
	public String getStored_location() {
		return stored_location;
	}
	public void setStored_location(String stored_location) {
		this.stored_location = stored_location;
	}
	public String getStored_or_destroyed() {
		return stored_or_destroyed;
	}
	public void setStored_or_destroyed(String stored_or_destroyed) {
		this.stored_or_destroyed = stored_or_destroyed;
	}
	public LabTestRequest getFlabtestrequest_ID() {
		return flabtestrequest_ID;
	}
	public void setFlabtestrequest_ID(LabTestRequest flabtestrequest_ID) {
		this.flabtestrequest_ID = flabtestrequest_ID;
	}
	public int getSpecimen_ID() {
		return specimen_ID;
	}
	public void setSpecimen_ID(int specimen_ID) {
		this.specimen_ID = specimen_ID;
	}
	public Date getSpecimen_CollectedDate() {
		return specimen_CollectedDate;
	}
	public void setSpecimen_CollectedDate(Date specimen_CollectedDate) {
		this.specimen_CollectedDate = specimen_CollectedDate;
	}
	public Date getSpecimen_ReceivedDate() {
		return specimen_ReceivedDate;
	}
	public void setSpecimen_ReceivedDate(Date specimen_ReceivedDate) {
		this.specimen_ReceivedDate = specimen_ReceivedDate;
	}
	public String getRemarks() {
		return remarks;
	}
	public void setRemarks(String remarks) {
		this.remarks = remarks;
	}
	public Date getSpecimen_DeliveredDate() {
		return specimen_DeliveredDate;
	}
	public void setSpecimen_DeliveredDate(Date specimen_DeliveredDate) {
		this.specimen_DeliveredDate = specimen_DeliveredDate;
	}
	public AdminUser getfSpecimen_CollectedBy() {
		return fSpecimen_CollectedBy;
	}
	public void setfSpecimen_CollectedBy(AdminUser fSpecimen_CollectedBy) {
		this.fSpecimen_CollectedBy = fSpecimen_CollectedBy;
	}
	public AdminUser getfSpecimen_ReceivededBy() {
		return fSpecimen_ReceivededBy;
	}
	public void setfSpecimen_ReceivededBy(AdminUser fSpecimen_ReceivededBy) {
		this.fSpecimen_ReceivededBy = fSpecimen_ReceivededBy;
	}
	public AdminUser getfSpecimen_DeliveredBy() {
		return fSpecimen_DeliveredBy;
	}
	public void setfSpecimen_DeliveredBy(AdminUser fSpecimen_DeliveredBy) {
		this.fSpecimen_DeliveredBy = fSpecimen_DeliveredBy;
	}
	public SpecimenRetentionType getfRetentionType_ID() {
		return fRetentionType_ID;
	}
	public void setfRetentionType_ID(SpecimenRetentionType fRetentionType_ID) {
		this.fRetentionType_ID = fRetentionType_ID;
	}
	public SpecimenType getfSpecimentType_ID() {
		return fSpecimentType_ID;
	}
	public void setfSpecimentType_ID(SpecimenType fSpecimentType_ID) {
		this.fSpecimentType_ID = fSpecimentType_ID;
	}
	
	
	
	
	
	
	
	
	
}
