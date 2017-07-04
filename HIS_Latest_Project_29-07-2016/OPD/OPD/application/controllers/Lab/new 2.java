@Path("/getPrescription/{PRES_ID}")
	@Produces(MediaType.APPLICATION_JSON)
	public String getPrescriptionByPrescriptionId(
			@PathParam("PRES_ID") int PRES_ID) {
		try {

			Prescription prescription = prescriptionDBDriver
					.getPrescription(PRES_ID);

			JSONSerializer serializer = new JSONSerializer();

			return serializer
					.include("prescribeItems")
					.transform(new DateTransformer("yyyy-MM-dd"),
							"prescriptionDate", "prescriptionCreateDate",
							"prescriptionLastUpdate",
							"visit.patient.patientDateOfBirth",
							"visit.patient.patientCreateDate",
							"visit.patient.patientLastUpdate",
							"visit.visitDate", "visit.visitLastUpdate",
							"*.class").serialize(prescription);

		} catch (Exception e) {
			return "error" + e.getMessage();
		}
	}