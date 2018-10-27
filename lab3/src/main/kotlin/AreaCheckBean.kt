import java.io.Serializable

class AreaCheckBean : Serializable {
  private val history = ArrayList<RequestResult>()
  var x = 0.0
  var y = 0.0
  var r = 0.0

  fun tryHit() {
    if (!validate()) return
    history.add(RequestResult(x, y, r, checkHit()))
  }

  fun getResultsArray() = history.toTypedArray()

  private fun validate(): Boolean {
    // TODO add implementation for validating parameters
    return true
  }

  private fun checkHit(): Boolean {
    // TODO add implementation for checking area hit
    return true
  }
}