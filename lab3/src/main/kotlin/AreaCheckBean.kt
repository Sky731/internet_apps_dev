import java.io.Serializable
import java.lang.StringBuilder

class AreaCheckBean : Serializable {
  private val history = ArrayList<RequestResult>()
  var x = 0.0
  var y = 0.0
  var r = 0.0

  fun generateTable(): String {
    if (!validate()) return "Incorrect data"
    val isHit = checkHit()
    history.add(RequestResult(x, y, r, isHit))

    val resultTable = StringBuilder("<tr>")
    for (i in 0..history.size) {
      resultTable.append("<td>$i</td>" +
          "<td>${history[i].x}</td>" +
          "<td>${history[i].y}</td>" +
          "<td>${history[i].r}</td>" +
          "<td>${history[i].isHit}</td>")
    }
    resultTable.append("</tr>")
    return resultTable.toString()
  }

  private fun validate(): Boolean {
    // TODO add implementation for validating parameters
    return true
  }

  private fun checkHit(): Boolean {
    // TODO add implementation for checking area hit
    return true
  }
}