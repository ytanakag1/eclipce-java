import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;




public class DataAccess {

  public static void main(String[] args ) throws SQLException {
  
    
  	
  	DataAccess dataAccess = new DataAccess();

    try {
      dataAccess.selectOracle();
    } catch (Exception e) {
      e.printStackTrace();
    }
  }

  public void selectOracle() throws Exception {

    // ���[�U��
    String user = "scott";
    // �p�X���[�h
    String pass = "tiger";
    // �T�[�o��
    String servername = "localhost";
    // SID
    String sid = "orcl";

    Connection conn = null;
    Statement stmt = null;
    ResultSet rset = null;

    try {
      // JBBC�h���C�o�N���X�̃��[�h
      Class.forName("oracle.jdbc.driver.OracleDriver");

      // Connection�̍쐬
      conn = DriverManager.getConnection("jdbc:oracle:thin:@" + servername + ":1521:" + sid, user, pass);

      // Statement�̍쐬
      stmt = conn.createStatement();

      // Resultset�̍쐬
      rset = stmt.executeQuery("select EMPNO, ENAME, JOB from testdb");

      // �擾�����f�[�^���o�͂���
      while (rset.next()) {
        System.out.println(rset.getString("EMPNO") + "," + rset.getString("ENAME") + "," + rset.getString("JOB"));
      }

    } catch (ClassNotFoundException e) {
      throw e;
    } catch (SQLException e) {
      throw e;
    } catch (Throwable e) {
      throw e;
    } finally {
      try {
        /* �N���[�Y���� */
        if (rset != null) {
          rset.close();
          rset = null;
        }

        if (stmt != null) {
          stmt.close();
          stmt = null;
        }

        if (conn != null) {
          conn.close();
          conn = null;
        }
      } catch (Throwable e) {
          // nop
      }
    }
  }
}