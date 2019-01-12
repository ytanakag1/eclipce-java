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

    // ユーザ名
    String user = "scott";
    // パスワード
    String pass = "tiger";
    // サーバ名
    String servername = "localhost";
    // SID
    String sid = "orcl";

    Connection conn = null;
    Statement stmt = null;
    ResultSet rset = null;

    try {
      // JBBCドライバクラスのロード
      Class.forName("oracle.jdbc.driver.OracleDriver");

      // Connectionの作成
      conn = DriverManager.getConnection("jdbc:oracle:thin:@" + servername + ":1521:" + sid, user, pass);

      // Statementの作成
      stmt = conn.createStatement();

      // Resultsetの作成
      rset = stmt.executeQuery("select EMPNO, ENAME, JOB from testdb");

      // 取得したデータを出力する
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
        /* クローズ処理 */
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