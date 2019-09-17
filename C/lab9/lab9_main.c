#include "lab9.h"
#include "graphs.h"

int main(void) {

	GRAPH* graph;
	VERTEX* vnode = NULL;
	ARC* aptr = NULL;
	graph = graphCreate(compareInt);


	for (int i = 1; i <= 7; i++) {
		graphInsVrtx(graph, i);
	}
	
	graphInsArc(graph, 1, 2);
	graphInsArc(graph, 1, 4);
	graphInsArc(graph, 2, 1);
	graphInsArc(graph, 2, 3);
	graphInsArc(graph, 2, 5);
	graphInsArc(graph, 3, 2);
	graphInsArc(graph, 4, 1);
	graphInsArc(graph, 4, 5);
	graphInsArc(graph, 4, 7);
	graphInsArc(graph, 5, 2);
	graphInsArc(graph, 5, 4);
	graphInsArc(graph, 5, 6);
	graphInsArc(graph, 6, 5);
	graphInsArc(graph, 7, 4);
	puts("Graph breadth first:");
	graphBrdthFrst(graph, process);
	puts(" ");
	puts("Graph depth first:");
	graphDpthFrst(graph, process);
	puts(" ");

	for (vnode = graph->first; vnode != NULL; vnode = vnode->pNextVertex) {
		printf("vertex %d:", vnode->dataPtr);
		for (aptr = vnode->pArc; aptr != NULL; aptr= aptr->pNextArc) {
			printf(" -- [%d]", aptr->destination->dataPtr);
		}
		puts(" ");
	}
	system("pause");
}