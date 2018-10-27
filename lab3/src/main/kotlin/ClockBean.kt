import java.io.Serializable
import java.time.ZonedDateTime

class ClockBean : Serializable {

  fun getTime() = ZonedDateTime.now().toString()

}
