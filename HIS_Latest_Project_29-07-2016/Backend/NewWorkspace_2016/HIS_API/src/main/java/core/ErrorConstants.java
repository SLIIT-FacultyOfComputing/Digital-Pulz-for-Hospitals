package core;

public enum ErrorConstants {
	
	INVALID_ID("ERROR_001", "Invalid ID"),
	FILL_REQUIRED_FIELDS("ERROR_002", "Please fill all required information"),
	ENTRY_ALREADY_EXISTS("ERROR_003", "Entry already exists"),
	NO_CONNECTION("ERROR_004","Check Network Connection"),
	NO_DATA("ERROR_005","Try again later"),
	RECORD_NOT_FOUND("ERROR_006","The Record is not found."),
	DELETE_ERROR("ERROR_007","The Record cannot be deleted."),
	DATE_FORMAT_ERROR("ERROR_008","Date Format is Wrong."),
	DATABASE_ERROR("ERROR_009", "An error occured in the database"),
	INVALID_REQUEST("ERROR_010","The request is invalid"),
	MISSING_PARAMETER("ERROR_011","Required query parameter is missing");

    private final String code;
	private final String message;

	private ErrorConstants(String code, String message) {
		this.code = code;
		this.message = message;
	}

	public String getMessage() {
	     return message;
	}

	public String getCode() {
	     return code;
	}

	@Override
	public String toString() {
	    return code + ": " + message;
	}
	
}
