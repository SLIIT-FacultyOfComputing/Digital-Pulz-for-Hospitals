/*
-----------------------------------------------------------------------------------------------------------------------------------
HIS – Health Information System - RESTful  API
-----------------------------------------------------------------------------------------------------------------------------------
This is a free and open source API which can be used to develop and distributed in the hope that it will be useful to develop EMR systems.
You can utilize the services provides by the API to speed up the development process. 
You can modify the API to cater your requirements at your own risk. 
 
-----------------------------------------------------------------------------------------------------------------------------------
Authors: H.L.M.M De Silva, K.V.M Jayadewa, G.A.R Perera, S.I Kodithuwakku
Supevisor: Dr. Koliya Pulasinghe | Dean /Faculty of Graduate Studies |SLIIT
Co-Supervisor: Mr.Indraka Udayakumara | Senior Lecturer | SLIIT
URL: https://sites.google.com/a/my.sliit.lk/his
----------------------------------------------------------------------------------------------------------------------------------
*/
package lib.classes.securitymodel.encryption;


import java.security.SecureRandom;

import javax.crypto.SecretKeyFactory;
import javax.crypto.spec.PBEKeySpec;
import java.math.BigInteger;
import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;


/**
 * DataHashing class contains all the methods regarding data encryption in the system
 * @author MIYURU
 *
 */

public class DataHashing {


	public static final String PBKDF2_ALGORITHM = "PBKDF2WithHmacSHA1";
    public static final int SALT_BYTE_SIZE = 24;
    public static final int HASH_BYTE_SIZE = 24;
    public static final int PBKDF2_ITERATIONS = 1000;

    public static final int ITERATION_INDEX = 0;
    public static final int SALT_INDEX = 1;
    public static final int PBKDF2_INDEX = 2;
    
    
    public String createHash(String password)throws NoSuchAlgorithmException, InvalidKeySpecException
    {
        return createHash(password.toCharArray());
    }
    
    public static String createHash(char[] password) throws NoSuchAlgorithmException, InvalidKeySpecException
    {
        // Generate a random salt
        SecureRandom random = new SecureRandom();
        byte[] salt = new byte[SALT_BYTE_SIZE];
        random.nextBytes(salt);

        // Hash the password
        byte[] hash = pbkdf2(password, salt, PBKDF2_ITERATIONS, HASH_BYTE_SIZE);
        // format iterations:salt:hash
        return PBKDF2_ITERATIONS + ":" + toHex(salt) + ":" +  toHex(hash);
    }
    
    
    public  boolean validatePassword(String password, String correctHash)throws NoSuchAlgorithmException, InvalidKeySpecException
    {

        return validatePassword(password.toCharArray(), correctHash);
    }
    
    
    public static boolean validatePassword(char[] password, String correctHash) throws NoSuchAlgorithmException, InvalidKeySpecException
    {
        // Decode the hash into its parameters
    	boolean r;
        String[] params = correctHash.split(":");
        int iterations = Integer.parseInt(params[ITERATION_INDEX]);
        byte[] salt = fromHex(params[SALT_INDEX]);
        byte[] hash = fromHex(params[PBKDF2_INDEX]);
        // Compute the hash of the provided password, using the same salt, 
        // iteration count, and hash length
        byte[] testHash = pbkdf2(password, salt, iterations, hash.length);
        // Compare the hashes in constant time. The password is correct if
        // both hashes match.
        
        r=slowEquals(hash, testHash);
        
        return r;
    }
    
    private static boolean slowEquals(byte[] a, byte[] b)
    {
        int diff = a.length ^ b.length;
        for(int i = 0; i < a.length && i < b.length; i++)
            diff |= a[i] ^ b[i];
        return diff == 0;
    }
    
    private static byte[] pbkdf2(char[] password, byte[] salt, int iterations, int bytes) throws NoSuchAlgorithmException, InvalidKeySpecException
    {
        PBEKeySpec spec = new PBEKeySpec(password, salt, iterations, bytes * 8);
        
        SecretKeyFactory skf = SecretKeyFactory.getInstance(PBKDF2_ALGORITHM);
        return skf.generateSecret(spec).getEncoded();
    }
    
    
    private static byte[] fromHex(String hex)
    {
        byte[] binary = new byte[hex.length() / 2];
        for(int i = 0; i < binary.length; i++)
        {
            binary[i] = (byte)Integer.parseInt(hex.substring(2*i, 2*i+2), 16);
        }
        return binary;
    }
    
    private static String toHex(byte[] array)
    {
        BigInteger bi = new BigInteger(1, array);
        String hex = bi.toString(16);
        int paddingLength = (array.length * 2) - hex.length();
        if(paddingLength > 0) 
            return String.format("%0" + paddingLength + "d", 0) + hex;
        else
            return hex;
    }
	
	
}
