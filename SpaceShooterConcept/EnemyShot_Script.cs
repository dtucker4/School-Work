/// <summary>
/// 2D Space Shooter Example
/// By Bug Games www.Bug-Games.net
/// Programmer: Danar Kayfi - Twitter: @DanarKayfi
/// Special Thanks to Kenney for the CC0 Graphic Assets: www.kenney.nl
/// 
/// This is the EnemyShot Script:
/// - Enemy Ship Shot velocity
/// 
/// </summary>

using UnityEngine;
using System.Collections;

public class EnemyShot_Script : MonoBehaviour 
{
	//Public Var
	public float speed; //EnemyRed Shot Speed
    public Transform target;
    // Use this for initialization
    void Start ()
	{
        GameObject player = GameObject.FindGameObjectWithTag("Player");
        if (player != null) { 
        target = player.transform;
        transform.position = Vector2.MoveTowards(transform.position, target.position, speed * Time.deltaTime);

        Vector2 direction = new Vector2(target.position.x, target.position.y);

        direction.Normalize();
        var angle = Mathf.Atan2(direction.y, direction.x) * Mathf.Rad2Deg;

       
        GetComponent<Rigidbody2D>().velocity = direction * speed; //Give Velocity to the Enemy ship shot
        transform.rotation = Quaternion.AngleAxis(angle, Vector3.forward);
        }
    }
}
