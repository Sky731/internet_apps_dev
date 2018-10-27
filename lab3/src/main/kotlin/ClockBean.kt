import java.io.Serializable
import java.time.ZonedDateTime
import java.time.format.DateTimeFormatter

class ClockBean : Serializable {

  fun getTime() = DateTimeFormatter.ofPattern("dd/MM/yyyy - hh:mm:ss")
      .format(ZonedDateTime.now()).toString()

}
